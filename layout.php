<?php

/**
 * Layout for the article editor
 *
 * @param string $content
 * @return void
 */
function wfRenderLayout( string $content = "" ) {
	echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Article Editor</title>
	<link rel='stylesheet' href='http://design.wikimedia.org/style-guide/css/build/wmui-style-guide.min.css'>
	<link rel='stylesheet' href='styles.css'>
	<script src='main.js'></script>
</head>
<body>
	$content
</body>
</html>
HTML;
}
