<?php
namespace cases\catalog;

use \PHPUnit\Framework\TestCase;
use \library\catalog;

class LoginTest extends TestCase
{
	public function testSimpleLoginSuccessful()
	{
		$catalog = new catalog();
		$html = $catalog->login_simple();

		$success = str_contains($html, "Success");
		$this->assertFalse($success, "Error - Simple login passed the gateway.");
	}

	public function testAdvancedLoginSuccessful()
	{
		$catalog = new catalog();
		$html = $catalog->login_advanced();
		// {"redirect":"...index.php?route=account/account&language=en-gb&customer_token=2aabe45515d06814ee9ff9d415"}
        $json = json_decode($html, true);

        $this->assertArrayHasKey("redirect", $json, "Failed reading redirect information.");

		$this->assertFalse(str_contains($html, "warning"), "Login returned warning.");
		$this->assertFalse(str_contains($html, "error"), "Login returned warning.");
	}

	public function testSimpleLoginFailure()
    {
        // login with just invalid credentials
        $this->markTestSkipped("Not implemented.");
    }

    public function testAdvancedLoginFailure()
    {
        // login with wrong credentials and a token
        $this->markTestSkipped("Not implemented.");
    }
}