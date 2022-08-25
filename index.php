<?php

// TODO: Improve the readability of this file through refactoring and documentation.

// TODO: Review the index.php entrypoint for security and performance concerns.
//  You can document any concerns inline via comments or fix issues, depending
//  what you want to focus on

// TODO: The visual layout of the application is not good. Change the code to improve
//   the user experience.

// TODO: The list of available articles is hardcoded. Add code to get a dynamically
//  generated list.

// TODO: Are there performance problems with the word count function? How could you
//  optimize this to perform well with large amounts of data? Code comments / psuedo-code welcome.

// TODO: Review the HTML structure and make sure that it is valid and contains required elements.
//  Re-organize the HTML as needed.

use App\App;

require_once __DIR__ . '/vendor/autoload.php';

$app = new App();

echo "<head>
<link rel='stylesheet' href='http://design.wikimedia.org/style-guide/css/build/wmui-style-guide.min.css'>
<script src='http://code.jquery.com/jquery-3.6.0.min.js'></script>
<script src='main.js'></script>
</head>";

$title = '';
$body = '';
if ( isset( $_GET['title'] ) ) {
	$title = $_GET['title'];
	$body = $app->fetch( $_GET );
	$body = file_get_contents( sprintf( 'articles/%s', $title ) );
}

$wordCount = wfGetWc();
echo "<body>";
echo "<header id=header class=header>' .
'<div class='content-box'><a href='/'><h1 class='site__title'>Article editor</h1></a><div>$wordCount</div></div></header>";
echo "<div class=page>";
echo "<div class=content-box>";
echo "<div class='col'>";
 echo "<form action='index.php' method='post'>
<input name='title' type='text' placeholder='Article title...' value=$title>
<br />
<textarea name='body' placeholder='Article body...' >$body</textarea>
<br />
<input type='submit' name='submit' value='Submit' />
<br />
</div>
<div class='col'>
<h2>Preview</h2>
$title\n\n
$body
</div>
<h2>Articles</h2>
<ul>
<li><a href='index.php?title=Foo'>Foo</a></li>
</ul>
</form>";

if ( $_POST ) {
	$app->save( sprintf( "articles/%s", $_POST['title'] ), $_POST['body'] );
}
echo "</div>";
echo "</div>";
echo "</body";

function wfGetWc() {
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
