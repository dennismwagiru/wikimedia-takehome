<?php

// TODO B: Review the HTML structure and make sure that it is valid and contains
// required elements. Edit and re-organize the HTML as needed.

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

$app = new App();

echo <<<HTML
<head>
<link rel='stylesheet' href='http://design.wikimedia.org/style-guide/css/build/wmui-style-guide.min.css'>
<link rel='stylesheet' href='styles.css'>
<script src='main.js'></script>
</head>
HTML;

$title = '';
$body = '';
if ( isset( $_GET['title'] ) ) {
	$title = htmlentities( $_GET['title'] );
	$body = file_get_contents( sprintf( 'articles/%s', $title ) );
}

/**
 * Render the header of the page
 *
 * @param string $wordCount
 * @return void
 */
function wfRenderHeader( string $wordCount ) {
	echo <<<HTML
<body>
<div id=header class=header>
<a href='/'>Article editor</a><div>$wordCount</div>
</div>
<div class='page'>
<div class='main'>
HTML;
}

/**
 * Render the form for creating/editing an article
 *
 * @param string $title
 * @param string $body
 * @return void
 */
function wfRenderForm( string $title = '', string $body = '' ) {
	$titleEsc = htmlspecialchars( $title, ENT_QUOTES );
	$bodyEsc = htmlspecialchars( $body, ENT_QUOTES | ENT_SUBSTITUTE );
	echo <<<HTML
<h2>Create/Edit Article</h2>
<p>Create a new article by filling out the fields below. Edit an article by typing the beginning of the title in the title field, selecting the title from the auto-complete list, and changing the text in the textfield.</p>
<form action='index.php' method='post'>
<input name='title' type='text' placeholder='Article title...' value="$titleEsc">
<br />
<textarea name='body' placeholder='Article body...' >$bodyEsc</textarea>
<br />
<a class='submit-button' href='#' />Submit</a>
<br />
<h2>Preview</h2>
<div class="preview">
<pre>$titleEsc\n\n$bodyEsc</pre>
</div>

<h2>Articles</h2>
<ul>
<li><a href='index.php?title=Foo'>Foo</a></li>
</ul>
</form>
HTML;
}

$wordCount = wfGetWc();

wfRenderHeader( $wordCount );
wfRenderForm( $title, $body );

if ( $_POST ) {
	$app->save( sprintf( "articles/%s", $_POST['title'] ), $_POST['body'] );
}
echo <<<HTML
</div>
</div>
</body>
HTML;

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
