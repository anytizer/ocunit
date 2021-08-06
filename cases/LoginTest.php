<?php
namespace cases;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \MySQLPDO;

class LoginTest extends TestCase
{
	public function testSimpleLoginWorks()
	{
		$username = "opencart";
		$password = "shop009";

		$_GET = [];
		$_POST = [];
		$relay = new relay();
		$html = $relay->fetch(HTTP_SERVER);

		$success = str_contains($html, "Success");
		$this->assertTrue($success, "Failed simple log in");
	}

	public function testProtectedLoginWorks()
	{
		$_GET = [
			"route" => "account/login|login",
			"language" => "en-gb",
			"login_token" => "5654914f48eccb41c6eb08fec3",
		];

		$relay = new relay();
		$html = $relay->fetch(HTTP_SERVER."index.php");

		$this->assertTrue(str_contains($html, "Success"), "Failed protected log in.");
		$this->assertFalse(str_contains($html, "warning"), "Login returned warning.");
		$this->assertFalse(str_contains($html, "error"), "Login returned warning.");
		// http://localhost/opencart/upload/index.php?route=account/login|login&language=en-gb&login_token=5654914f48eccb41c6eb08fec3
	}
}