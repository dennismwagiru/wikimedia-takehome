<?php

use App\App;

require_once __DIR__ . '/vendor/autoload.php';

$app = new App();

// TODO: Double check HTML validity
// TODO: Security review
echo "<head>
<link rel='stylesheet' href='http://design.wikimedia.org/style-guide/css/build/wmui-style-guide.min.css'>
<script src='http://code.jquery.com/jquery-3.6.0.min.js'></script>
<script src='main.js'></script>
</head>";

$title = '';
$body = '';
// TODO: cleaner way to handle GET/POST in this file?
if (isset( $_GET['title'] ) ) {
    $title = $_GET['title'];
	$body = $app->fetch( $_GET );
    $body = file_get_contents( sprintf('articles/%s', $title ) );
}

$wordCount = getWordCount();
// TODO: Writing HTML by concatenating strings :(
echo "<body>";
echo "<header id=header class=header><div class='content-box'><a href='/'><h1 class='site__title'>WikiPHPedia</h1></a><div>$wordCount</div></div></header>";
echo "<div class=page>";
echo "<div class=content-box>";
echo "<div class='col'>";
 echo "<form action='index.php' method='post'>
<!-- TODO: Auto complete widget to load existing articles when typing in this
box would be nice -->
<input name='title' type='text' placeholder='Article title...' value=$title>
<br />
<textarea name='body' placeholder='Article body...' >$body</textarea>
<br />
<input type='submit' name='submit' value='Submit' />
<br />
</div>
<!-- TODO: Preview should be adjacent to the text area -->
<div class='col'>
<h2>Preview</h2>
$title\n\n
$body
</div>
<!-- TODO: Articles should be in a separate row below the text editor and preview -->
<h2>Articles</h2>
<ul>
<!-- TODO: Get a dynamically generated list of articles from the articles directory -->
<li><a href='index.php?title=Foo'>Foo</a></li>
</ul>
</form>";

if ( $_POST ) {
    // TODO: "Wikify" the title (E.g. lowercase "foo" is "Foo", "Foo bar" is "Foo_bar")
	$app->save( sprintf("articles/%s", $_POST['title'] ), $_POST['body'] );
}
echo "</div>";
echo "</div>";
echo "</body";

// TODO: Consider optimizing.
function getWordCount() {
	global $baseArticlePath;
	$baseArticlePath = 'articles/';
	$wc = 0;
	$dir = new DirectoryIterator($baseArticlePath);
	foreach ($dir as $fileinfo) {
		if ( $fileinfo->isDot() ) {
			continue;
		}
		$c = file_get_contents( $baseArticlePath . $fileinfo->getFilename() );
		$ch = explode( " ", $c );
		$wc += count($ch);
	}
	return "$wc words written";
}
