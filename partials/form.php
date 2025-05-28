<?php

/**
 * Render the form for creating/editing an article
 *
 * @param string $title
 * @param string $body
 * @return string
 */
function wfRenderForm( string $title = '', string $body = '' ): string {
	$titleEsc = htmlspecialchars( $title, ENT_QUOTES );
	$bodyEsc = htmlspecialchars( $body, ENT_QUOTES | ENT_SUBSTITUTE );

	return <<<HTML
<div class="page">
	<div class="main">

		<h2>Create/Edit Article</h2>
		<p>
			Create a new article by filling out the fields below. Edit an article by typing the beginning of the
			title inthe title field, selecting the title from the auto-complete list, and changing the text in
			the textfield.
		</p>

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

	</div>
</div>
HTML;
}
