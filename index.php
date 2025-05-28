<?php

// TODO C: Review the index.php entrypoint for security and performance concerns
// and provide fixes. Note any issues you don't have time to fix.

// TODO D: The list of available articles is hardcoded. Add code to get a
// dynamically generated list.

// TODO E: Are there performance problems with the word count function? How
// could you optimize this to perform well with large amounts of data? Code
// comments / psuedo-code welcome.

// TODO F: Implement a simple unit test to ensure the correctness of different parts
// of the application.

use App\App;

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/layout.php';
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/partials/form.php';

$app = new App();

$title = '';
$body = '';
if ( isset( $_GET['title'] ) ) {
	$title = htmlentities( $_GET['title'] );
	$body = file_get_contents( sprintf( 'articles/%s', $title ) );
}

$wordCount = wfGetWc();
$header = wfRenderHeader( $wordCount );
$form = wfRenderForm( $title, $body );

if ( $_POST ) {
	$app->save( sprintf( "articles/%s", $_POST['title'] ), $_POST['body'] );
}

wfRenderLayout( $header . $form );

/**
 * Get the word count of all articles
 *
 * @return string
 */
function wfGetWc(): string {
	global $wgBaseArticlePath;
	$wgBaseArticlePath = 'articles/';
	$wc = 0;
	$dir = new DirectoryIterator( $wgBaseArticlePath );
	foreach ( $dir as $fileinfo ) {
		if ( $fileinfo->isDot() ) {
			continue;
		}
		$c = file_get_contents( $wgBaseArticlePath . $fileinfo->getFilename() );
		$ch = explode( " ", $c );
		$wc += count( $ch );
	}
	return "$wc words written";
}
