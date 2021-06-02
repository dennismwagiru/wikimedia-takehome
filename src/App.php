<?php

namespace App;

class App {

	public function save( $ttl, $bd ) {
		error_log( "Saving article $ttl, success!" );
		file_put_contents( $ttl, $bd );
	}

	public function fetch( $get ) {
		return is_array( $get ) ? file_get_contents( sprintf('articles/%s', $get['title'] ) ) :
			file_get_contents( sprintf( 'articles/%s', $_GET['title'] ) );
	}
}
