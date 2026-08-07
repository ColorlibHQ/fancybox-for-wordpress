#!/usr/bin/env node
/**
 * Fails if a committed *.min.* file is out of date with its source.
 *
 * The minified assets are what actually ship (mfbfw_asset_suffix() only serves the
 * readable sources under SCRIPT_DEBUG), so an edit to fancybox.css that forgets the
 * rebuild silently ships the old stylesheet to every visitor. This rebuilds each
 * pair into a temp file and byte-compares.
 */
import { execFileSync } from 'node:child_process';
import { mkdtempSync, readFileSync, rmSync } from 'node:fs';
import { tmpdir } from 'node:os';
import { join } from 'node:path';

const PAIRS = [
	{
		source: 'assets/js/jquery.fancybox.js',
		minified: 'assets/js/jquery.fancybox.min.js',
		build: (src, out) => [
			'terser',
			[ src, '--compress', '--mangle', '--comments', '/^!|licen[cs]e|fancyBox v/i', '-o', out ],
		],
	},
	{
		source: 'assets/css/fancybox.css',
		minified: 'assets/css/fancybox.min.css',
		build: ( src, out ) => [ 'cleancss', [ '-O2', '-o', out, src ] ],
	},
];

const tmp = mkdtempSync( join( tmpdir(), 'fbfw-assets-' ) );
let failed = 0;

try {
	for ( const pair of PAIRS ) {
		const out = join( tmp, pair.minified.replace( /\//g, '_' ) );
		const [ cmd, args ] = pair.build( pair.source, out );

		try {
			execFileSync( join( 'node_modules', '.bin', cmd ), args, { stdio: 'pipe' } );
		} catch ( e ) {
			console.error( `  ERROR  ${ pair.minified } — could not run ${ cmd }. Did you run \`npm install\`?` );
			failed++;
			continue;
		}

		const fresh = readFileSync( out );
		let committed;
		try {
			committed = readFileSync( pair.minified );
		} catch {
			console.error( `  STALE  ${ pair.minified } is missing — run \`npm run build:assets\`` );
			failed++;
			continue;
		}

		if ( fresh.equals( committed ) ) {
			console.log( `  ok     ${ pair.minified } (${ committed.length } bytes) matches ${ pair.source }` );
		} else {
			console.error(
				`  STALE  ${ pair.minified } does not match ${ pair.source } ` +
				`(committed ${ committed.length } bytes, rebuild ${ fresh.length }) — run \`npm run build:assets\``
			);
			failed++;
		}
	}
} finally {
	rmSync( tmp, { recursive: true, force: true } );
}

if ( failed ) {
	console.error( `\n${ failed } asset(s) out of date.` );
	process.exit( 1 );
}
console.log( '\nAll minified assets are current.' );
