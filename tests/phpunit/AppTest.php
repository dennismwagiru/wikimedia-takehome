<?php

namespace Tests;

use App\App;

class AppTest extends \PHPUnit\Framework\TestCase {

	public function testGet() {
		$app = new App();
		// TODO: Fix failing test
		$x = $app->fetch( [ 'title' => 'Foo' ] );
		$this->assertContains( 'Use of metasyntactic variables', $x );
	}
}
