<?php

/**
 * Render the header of the page
 * @param string $wordCount
 * @return string
 */
function wfRenderHeader( string $wordCount = '' ): string {
	return <<<HTML
<div id="header" class="header">
	<a href="/">Article editor</a>
	<div>$wordCount</div>
</div>
HTML;
}
