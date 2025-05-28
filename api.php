<?php

/**
 * Simple JSON API for retriving and searching article content.
 *
 * Supported endpoints:
 *  - GET /api?title={title} - Fetch the full content of an article
 *  - GET /api?prefixsearch={prefix} - Get a list of articles that start with the given prefix
 *  - GET /api - Fetch a list of all articles
 *
 * Response format:
 * {
 * 		"content": string | array,
 * 		"error"?: string | null
 * }
 *
 * Example URLs:
 *  - /api?title=Foo
 *  - /api?prefixsearch=Foo
 *  - /api
 *
 * Notes:
 * - Uses basename() to prevent path traversal attacks
 * - no authentication required (public access).
 * - Outputs proper HTTP status codes.
 */

use App\App;

require_once __DIR__ . '/vendor/autoload.php';

$app = new App();

/**
 * @param array $data
 * @param int $status
 * @return void
 */
function wfRespond( array $data, int $status = 200 ) {
	http_response_code( $status );
	echo json_encode( $data );
	exit;
}

header( 'Content-Type: application/json' );

$title = isset( $_GET['title'] ) ? basename( $_GET['title'] ) : null;
$prefix = isset( $_GET['prefixsearch'] ) ? $_GET['prefixsearch'] : null;

if ( $title ) {
	$content = $app->fetch( [ 'title' => $title ] );
	if ( !$content ) {
		wfRespond( [ 'error' => 'Article not found' ], 404 );
	}
	wfRespond( [ 'content' => $content ] );
}

if ( $prefix ) {
	$list = $app->getListOfArticles();
	$matches = array_filter( $list, static function ( $item ) use ( $prefix ) {
		return strpos( $item, $prefix ) === 0;
	} );
	wfRespond( [ 'content' => array_values( $matches ) ] );
}

wfRespond( [ 'content' => $app->getListOfArticles() ] );
