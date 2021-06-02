<?php

require_once 'globals.php';

global $baseArticlePath;

$count = 0;
// TODO: Make the number configurable.
for ($i = 0; $i < 1000; $i++) {
	$l = new \joshtronic\LoremIpsum();
	$l->words();
	file_put_contents(sprintf("%s/%s", $baseArticlePath, $l->word()), $l->paragraphs(10));
	echo "Creating article\n";
	$count++;
}
echo "generated $count articles!";

