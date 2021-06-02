<?php

use App\App;

require_once __DIR__ . '/vendor/autoload.php';

$app = new App();
// FIXME: Not displaying as JSON in browser.
echo json_encode( [ 'content' => $app->fetch( $_GET ) ] );

