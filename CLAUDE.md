# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

`FancyBox for WordPress` — a WordPress.org plugin (slug `fancybox-for-wordpress`, text domain `mfbfw`) by Colorlib that wires fancyBox 3 into any WordPress site. Requires PHP 7.4+ / WP 5.6+.

There is **no test suite and no linter**, and PHP/CSS/JS are edited directly rather than compiled. There *is* a Grunt build — `Gruntfile.js` + `package.json` — but it lives only in the [GitHub repo](https://github.com/ColorlibHQ/fancybox-for-wordpress) and is excluded from the distributed package, so it is absent from a working copy unzipped from WordPress.org. It provides:

- `grunt i18n` — `checktextdomain` (already configured to expect `fancybox-for-wordpress`) plus `makepot`
- `grunt build-archive` — copies to `build/`, minus dev files, and zips it

Its `copy.build` exclude list is the authority on what ships when releasing from GitHub; `.distignore` covers the same ground for `wp dist-archive` and the wp.org deploy action. **Keep the two in sync** — a file excluded from one but not the other will leak into some builds and not others.

## Development workflow

The repo directory *is* the plugin directory. To exercise changes, symlink it into a WordPress install — the sibling Colorlib plugins in the user's Local WP site follow this convention:

```bash
ln -s "/Users/silkalns/Fresh Projects/fancybox-for-wordpress" \
      "/Users/silkalns/Local Sites/local-wp/app/public/wp-content/plugins/fancybox-for-wordpress"
```

That site has the official `plugin-check` plugin installed — run it before shipping.

Settings live at **Settings → Fancybox for WP** (`options-general.php?page=fancybox-for-wordpress`).

### Checking PHP diagnostics without WordPress

There is no test suite, but the plugin can be loaded under plain PHP CLI against a stub of the ~60 WordPress functions it uses, which surfaces warnings/deprecations across settings states (fresh install, legacy option array, corrupted option row). This is how the PHP 8 defects fixed in 3.4.0 were found and verified — the scenarios that matter are *fresh front-end request* and *legacy option array on a front-end request*, because those are the paths where the settings array is least complete. Lint at minimum:

```bash
find . -name "*.php" -exec php -l {} \;
node --check assets/js/admin.js
```

### Version bumps touch three places, and they must agree

1. `fancybox.php` header `* Version:`
2. `fancybox.php` `define( 'FBFW_VERSION', ... )`
3. `readme.txt` `Stable tag:` (plus a new `== Changelog ==` entry)

`mfbfw_maybe_upgrade_settings()` compares the stored `mfbfw_active_version` against `FBFW_VERSION`; if the constant lags the header, the migration never runs.

## Architecture

### Settings flow through one schema

[`mfbfw_option_schema()`](fancybox.php) is the single source of truth. Each option declares a type (`toggle`, `color`, `int`, `float`, `choice`, `js`) and a default, and that table drives three things:

- `mfbfw_defaults()` — the defaults array.
- `mfbfw_sanitize_fancy_options()` — the save-time allow-list (`pre_update_option` via `register_setting`). Keys not in the schema are **dropped**.
- `mfbfw_get_settings()` — the read-time normalizer. Always returns a complete array with every value coerced to its declared type, so output code never has to guard.

**Every consumer must go through `mfbfw_get_settings()`**, never `get_option( 'mfbfw' )` directly. The `$mfbfw` global still exists for third-party readers and is populated from it.

For checkbox options use **`mfbfw_is_on( $key )`**, never a bare `isset()`. Toggles are stored as `'on'` / `''`, and a plain `isset()` is always true once the key exists — that bug silently disabled the Overlay, Title and Zoom On Click settings until 3.4.0.

Adding a setting = one schema entry + one field in the relevant `lib/admin-tab-*.php` partial. Nothing else. A schema key with no matching form field gets reset to its default on every save (only `copyTitleFunction` is deliberately in that state).

Legacy FancyBox 1.x keys (`borderRadius`, `shadowSize`, `easing`, …) are marked `'optional' => true`: absent from defaults, but preserved on read and on save so upgraded sites keep their styling.

### The front end: PHP settings → inline CSS + JS

`mfbfw_init()` prints an inline `<style>` and `<script>` into `wp_head` (or `wp_footer` when `loadAtFooter` is set). It delegates generation to focused helpers, and this is where nearly every front-end bug lives:

| Helper | Produces |
| --- | --- |
| `mfbfw_build_css()` | the inline stylesheet |
| `mfbfw_build_options()` | the fancyBox option object — scalars as JSON, functions as raw JS |
| `mfbfw_thumbnail_selector_js()` | which `<a>` elements become lightbox links |
| `mfbfw_gallery_js()` | the 5-way `galleryType` branch that assigns `data-fancybox` groups |
| `mfbfw_caption_js()` / `mfbfw_after_load_js()` / `mfbfw_title_copy_js()` | the caption/title callbacks |

Scalar options are `wp_json_encode()`d rather than interpolated by hand; function-valued options are assigned onto the object afterwards. Keep that split — hand-interpolating a scalar is how the unquoted `animationDuration` JS injection happened.

`mfbfw_is_enabled()` centralizes the "should this run at all" checks (mobile, WooCommerce shop/product) and is filterable via `mfbfw_is_enabled`.

### The vendored library is namespaced

[assets/js/jquery.fancybox.js](assets/js/jquery.fancybox.js) is fancyBox **v3.5.7** with the jQuery plugin name rewritten from `fancybox` to **`fancyboxforwp`** throughout (~94 sites) so it cannot collide with a theme's or another plugin's bundled copy. CSS class names are *not* renamed — they keep the upstream `fancybox-` prefix.

**Upgrading the library means re-applying that rename**, then regenerating `jquery.fancybox.min.js`.

### Assets

Minified files ship by default; `SCRIPT_DEBUG` switches to the readable sources via `mfbfw_asset_suffix()`. Both variants must exist for every asset:

| Source | Minified | Regenerate with |
| --- | --- | --- |
| `assets/js/jquery.fancybox.js` | `jquery.fancybox.min.js` | `npx terser@5 <src> --compress --mangle --comments '/^!\|licen[cs]e\|fancyBox v/i' -o <out>` |
| `assets/css/fancybox.css` | `fancybox.min.css` | `npx clean-css-cli@5 -O2 -o <out> <src>` |
| `assets/js/purify.js` | `purify.min.js` | ship both dist files from `npm pack dompurify@<version>`, stripping the `sourceMappingURL` comments |

After minifying, verify the namespace survived and the selector counts match:

```bash
node -e 'const $=require("jquery");' # or load in jsdom and assert typeof $.fn.fancyboxforwp === "function"
grep -o "fancybox-content" assets/css/fancybox.css | wc -l   # must equal the .min.css count
```

`assets/images/` was removed in 3.4.0 — all 22 files were FancyBox 1.x sprites that nothing referenced. fancyBox 3 draws its chrome with inline SVG.

### Admin UI

`mfbfw_admin_menu()` requires [admin.php](admin.php), which renders a jQuery UI Tabs container and requires six partials from [lib/](lib/).

[lib/admin-head.php](lib/admin-head.php) runs first and defines **ambient variables the partials depend on** — `$settings` (from `mfbfw_get_settings()`), plus `$transitionTypeArray`, `$overlayArray`, `$msArray`, `$slideEffectArray`. Partials are not self-contained.

Field markup follows a consistent pattern — an `.epsilon-toggle` block for booleans, `<select>` driven by one of the head arrays for enumerations, `.color-btn` for `wpColorPicker`, `.slider-horizontal` for jQuery UI sliders, `.start-editing` + `<textarea>` for CodeMirror fields. Copy an existing row rather than inventing new markup. Textareas use `esc_textarea()`.

[assets/js/admin.js](assets/js/admin.js) initializes tabs, pickers, sliders and CodeMirror, and drives dependent-block visibility. Strings come from the localized `fbfwAdmin` object — no inline `on*` handlers.

## Security surface

Releases 3.3.4 – 3.4.0 were dominated by security fixes. The risky code is structural:

- **Caption/title XSS.** DOMPurify (currently **3.4.13**, bundled) is a hard dependency of the `fancybox-for-wp` script handle. The generated `caption`, `afterLoad` and `copyTitleFunction` JS all route user HTML through `DOMPurify.sanitize(..., {USE_PROFILES: {html: true}})`, falling back to `jQuery("<div>").text(x).html()`. **Never remove either path.** Keep DOMPurify current — 3.1.6 shipped for a year while vulnerable to CVE-2025-26791.
- **Generated CSS is not escapable by `esc_html()`.** It only blocks `<`; a colour value can still close its declaration block. This is why colours go through `mfbfw_sanitize_hex_color()` and sizes through the `int` schema type. Never interpolate an unvalidated value into `mfbfw_build_css()`.
- **Intentional raw-JS injection.** `customExpression`, `extraCallsData` and the five `callbackOn*` settings are echoed through `html_entity_decode()` unescaped. Deliberate feature, gated on `manage_options` and `wp_strip_all_tags()` at save. Don't "fix" it by escaping — that breaks the feature — but don't widen it either.
- Every PHP file starts with `defined( 'ABSPATH' ) || exit;`. Keep that on new files.
- No external asset hosts. WordPress.org forbids CDN-loaded resources; the jQuery UI stylesheet is bundled at `assets/css/jquery-ui.css`. Its `url(img/…)` theme-image references were stripped — those files were never in the repo and only resolved on the CDN. If you re-import that stylesheet from upstream, strip them again or the settings screen 404s.

### Known, deliberately unfixed

`plugin-check` still reports ~22 warnings, all benign: `NonPrefixedVariableFound` (the ambient `$settings`/`$msArray` the admin partials rely on), `trademarked_term` ("WordPress" in the grandfathered plugin name), `NonPrefixedFunctionFound` (the deliberate `hexTorgba()` BC shim), `load_plugin_textdomain` (required — see below), and two dev-file warnings that `.distignore` keeps out of the package. **Zero ERROR-level findings.**

## Compatibility branches to preserve

Escape hatches that regressions tend to erase: `disableOnMobile` (checked server-side *and* re-checked in the browser, because a full-page cache can serve a desktop render to a phone), `nojQuery` (drops the jQuery dependency for troubleshooting), and the WooCommerce suppression in `mfbfw_is_enabled()`. The thumbnail selector's `.not('.envira-gallery-link').not('.ngg-simplelightbox')` exclusions avoid double-lightboxing with Envira and NextGen Gallery.

Option values are stored as strings (`'on'` / `''`, numeric strings for sizes) — `mfbfw_defaults()` deliberately casts numerics back to strings so strict comparisons in older themes keep working.

## Localization

Text domain is **`fancybox-for-wordpress`** — it must stay equal to the WordPress.org slug. WordPress resolves language packs as `{domain}-{locale}.mo`, and wp.org publishes them as `{slug}-{locale}`; when the two diverged (the domain was `mfbfw` until 3.4.0) **no community translation ever loaded**, despite 63 locales having work on translate.wordpress.org. Never rename the domain.

Loaded via `mfbfw_textdomain()` on `init` — earlier triggers WP 6.7+ `_load_textdomain_just_in_time` notices. `load_plugin_textdomain()` is still required despite `plugin-check` calling it discouraged: `WP_Textdomain_Registry::get_path_from_lang_dir()` searches `WP_LANG_DIR/plugins` and only falls back to a plugin's own `languages/` via the custom path that function registers. Dropping it would orphan the bundled files.

That fallback order also means **a wp.org language pack always beats a bundled file**, so bundling can never hold a locale back.

What ships in [languages/](languages/):

- `fancybox-for-wordpress.pot` — regenerate with `wp i18n make-pot . languages/fancybox-for-wordpress.pot --slug=fancybox-for-wordpress --exclude=assets/js/jquery.fancybox.js,assets/js/jquery.fancybox.min.js,assets/js/purify.js,assets/js/purify.min.js` (excluding the vendored libraries matters — otherwise their strings pollute the template).
- `.po` + `.mo` + `.l10n.php` for **de_DE, ja, pl_PL only**. Those three have no wp.org language pack, so the bundled copy is the sole source. Regenerate the fast format with `wp i18n make-php languages`; WP 6.5+ prefers `.l10n.php` and falls back to `.mo`, so ship both.

Before bundling a locale, check whether wp.org already ships a pack — `https://api.wordpress.org/translations/plugins/1.0/?slug=fancybox-for-wordpress&version=<v>`. If a pack exists, don't bundle; the pack wins and is usually more complete.

Strings go through `esc_html_e()` / `esc_html__()`, or `wp_kses_post( __( ... ) )` when they contain markup. Note `mfbfw` survives as the option name, function prefix, nonce and settings-group — only the *text domain* changed, so never blanket-replace the token.
