#!/usr/bin/php
<?php
require __DIR__ . '/../hasher.php';

// just use in command line
if( !isset( $argv ) ) {
	exit( 1 );
}

if( !isset( $argv[1] ) ) {
	echo "Usage: {$argv[0]} 'bla bla bla'\n";
	exit( 1 );
}

echo link_generator( $argv[1] ) . "\n";
