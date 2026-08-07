#!/usr/bin/env node
/**
 * Builds the distributable zip.
 *
 * Uses `rsync --exclude-from=.distignore`, which is exactly what the WordPress.org
 * deploy action does, so what you test locally is what gets published. .distignore
 * is the single source of truth for packaging — there is deliberately no second
 * exclude list to keep in sync.
 */
import { execFileSync } from 'node:child_process';
import { existsSync, mkdirSync, readFileSync, rmSync, statSync } from 'node:fs';
import { join } from 'node:path';

const pkg = JSON.parse( readFileSync( 'package.json', 'utf8' ) );
const slug = 'fancybox-for-wordpress';
const mainFile = 'fancybox.php';

// The plugin header is authoritative; these four drifting apart is a long-standing
// failure mode here, so treat a mismatch as an error rather than shipping it.
const header = readFileSync( mainFile, 'utf8' );
const headerVersion = header.match( /^\s*\*\s*Version:\s*(.+)$/m )?.[ 1 ].trim();
const constVersion = header.match( /FBFW_VERSION',\s*'([^']+)'/ )?.[ 1 ];
const readme = readFileSync( 'readme.txt', 'utf8' );
const stableTag = readme.match( /^Stable tag:\s*(.+)$/m )?.[ 1 ].trim();

const versions = { 'plugin header': headerVersion, FBFW_VERSION: constVersion, 'readme Stable tag': stableTag, 'package.json': pkg.version };
const unique = [ ...new Set( Object.values( versions ) ) ];
if ( unique.length !== 1 ) {
	console.error( 'Version mismatch:' );
	for ( const [ k, v ] of Object.entries( versions ) ) {
		console.error( `  ${ k.padEnd( 20 ) } ${ v }` );
	}
	process.exit( 1 );
}
const version = unique[ 0 ];

const buildDir = 'build';
const stage = join( buildDir, slug );
rmSync( buildDir, { recursive: true, force: true } );
mkdirSync( stage, { recursive: true } );

if ( ! existsSync( '.distignore' ) ) {
	console.error( '.distignore is missing; refusing to guess what should ship.' );
	process.exit( 1 );
}

execFileSync( 'rsync', [ '-a', '--exclude-from=.distignore', '--exclude=build', './', `${ stage }/` ], { stdio: 'inherit' } );

const zipName = `${ slug }-${ version }.zip`;
rmSync( join( buildDir, zipName ), { force: true } );
execFileSync( 'zip', [ '-qr', zipName, slug ], { cwd: buildDir, stdio: 'inherit' } );

const bytes = statSync( join( buildDir, zipName ) ).size;
const files = execFileSync( 'find', [ stage, '-type', 'f' ] ).toString().trim().split( '\n' ).length;

console.log( `\n  ${ join( buildDir, zipName ) }` );
console.log( `  version ${ version }  ·  ${ files } files  ·  ${ ( bytes / 1024 ).toFixed( 0 ) } KB` );

// A dev file in the package is the mistake worth catching automatically.
const leaked = execFileSync( 'find', [ stage, '-name', 'CLAUDE.md', '-o', '-name', '.distignore', '-o', '-name', 'Gruntfile.js', '-o', '-name', 'package.json', '-o', '-name', 'composer.json', '-o', '-name', 'node_modules' ] ).toString().trim();
if ( leaked ) {
	console.error( `\nDevelopment files leaked into the package:\n${ leaked }` );
	process.exit( 1 );
}
console.log( '  no development files in the package' );
