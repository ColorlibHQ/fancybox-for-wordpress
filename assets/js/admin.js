/* global wp, fbfwAdmin */
jQuery(function ($) {

    var strings = window.fbfwAdmin || {};

    // Tabs
    $("#fbfwTabs").tabs();

    // Show a dependent block only while its controlling checkbox is on.
    function switchBlock(block, button) {
        var $block = $(block),
            $button = $(button);

        if (!$block.length || !$button.length) {
            return;
        }

        $block.css("display", $button.is(":checked") ? "inline-block" : "none");

        $button.on("change", function () {
            $block.animate({
                opacity: "toggle",
                height: "toggle"
            }, 500);
        });
    }

    switchBlock("#borderColorBlock", "#border");
    switchBlock("#closeButtonBlock", "#showCloseButton");
    switchBlock("#overlayBlock", "#overlayShow");
    switchBlock("#titleBlock", "#titleShow");
    switchBlock("#callbackBlock", "#callbackEnable");
    switchBlock("#extraCallsBlock", "#extraCallsEnable");
    switchBlock("#easingBlock", "#easing");

    // Seed each slider from the input it controls before initialising it.
    $(".slider-horizontal").each(function () {
        var $slider = $(this);
        $slider.attr("defSl", $slider.prev("input").val());
    });

    // Enable CodeMirror on the JavaScript textareas on demand.
    $(".start-editing").on("click", function () {
        if (window.wp && wp.codeEditor) {
            wp.codeEditor.initialize($(this).next("textarea"));
        }
        $(this).hide();
    });

    $(".color-btn").wpColorPicker();

    $(".slider-horizontal").each(function () {
        var $slider = $(this),
            min = parseFloat($slider.attr("minSl")),
            max = parseFloat($slider.attr("maxSl")),
            def = parseFloat($slider.attr("defSl")),
            step = parseFloat($slider.attr("stepSl"));

        $slider.slider({
            orientation: "horizontal",
            range: "min",
            min: min,
            max: max,
            value: isNaN(def) ? min : def,
            step: step,
            slide: function (event, ui) {
                $slider.prev("input").val(ui.value);
            }
        });
    });

    // Title colour only applies to the "inside" position.
    function syncTitleColour() {
        var position = $("input.titlePosition:checked").val();
        $("#titleColorBlock").toggle("inside" === position);
    }

    syncTitleColour();
    $("input.titlePosition").on("change", syncTitleColour);

    // The custom expression editor only applies to the "custom" gallery type.
    function syncGalleryType() {
        var type = $("input.galleryType:checked").val();
        $("#customExpressionBlock").toggle("custom" === type);
    }

    syncGalleryType();
    $("input.galleryType").on("change", syncGalleryType);

    // Confirm before resetting. Previously an inline onClick attribute calling a
    // global function, which meant the markup depended on script load order.
    $("#reset").on("click", function () {
        return window.confirm(strings.confirmDefaults || "Are you sure you want to restore FancyBox for WordPress to default settings?");
    });

});
