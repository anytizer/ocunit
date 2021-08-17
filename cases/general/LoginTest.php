<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \library\catalog as catalog;

class LoginTest extends TestCase
{
	public function testSimpleLoginIsFunctional()
	{
		$catalog = new catalog();
		$html = $catalog->login_simple();

		$success = str_contains($html, "Success");
		$this->assertTrue($success, "Failed simple log in.");
	}

	public function testProtectedLoginIsFunctional()
	{
		$catalog = new catalog();
		$html = $catalog->login_advanced();

		$this->assertTrue(str_contains($html, "Success"), "Failed protected log in."); // Capital S
		$this->assertFalse(str_contains($html, "warning"), "Login returned warning.");
		$this->assertFalse(str_contains($html, "error"), "Login returned warning.");
	}
}