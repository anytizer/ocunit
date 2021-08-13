<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \library\catalog as catalog;

class LoginTest extends TestCase
{
	public function testSimpleLoginIsFunctional()
	{
		// http://localhost/opencart/upload/index.php?route=account/login|login&language=en-gb&login_token=d83e4e1f39e7859c30eddc998b

		$catalog = new catalog();
		$html = $catalog->login_simple();

		$success = str_contains($html, "Success");
		$this->assertTrue($success, "Failed simple log in.");
	}

	public function testProtectedLoginIsFunctional()
	{
		$catalog = new catalog();
		$html = $catalog->login_protected();

		$this->assertTrue(str_contains($html, "Success"), "Failed protected log in."); // Capital S
		$this->assertFalse(str_contains($html, "warning"), "Login returned warning.");
		$this->assertFalse(str_contains($html, "error"), "Login returned warning.");
		// http://localhost/opencart/upload/index.php?route=account/login|login&language=en-gb&login_token=5654914f48eccb41c6eb08fec3
	}
}