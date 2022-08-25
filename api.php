<?php

use App\App;

// TODO: Improve the readability of this file through refactoring and documentation.

require_once __DIR__ . '/vendor/autoload.php';

$app = new App();
// TODO: It would be nice to clean up the following code so that it's
// easier to see the different routes and handlers for the API, and
// simpler to add new ones.
header( 'Content-Type: application/json' );
if ( !isset( $_GET['title'] ) && !isset( $_GET['prefixsearch'] ) ) {
	echo json_encode( [ 'content' => $app->getListOfArticles() ] );
} elseif ( isset( $_GET['prefixsearch'] ) ) {
	$list = $app->getListOfArticles();
	$ma = [];
	foreach ( $list as $ar ) {
		if ( strpos( $ar, $_GET['prefixsearch'] ) !== false ) {
			$ma[] = $ar;
		}
	}
	echo json_encode( [ 'content' => $ma ] );
} else {
	echo json_encode( [ 'content' => $app->fetch( $_GET ) ] );
}
