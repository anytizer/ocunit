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
		$this->assertTrue($success, "Failed simple log in.");
	}

	public function testAdvancedLoginSuccessful()
	{
		$catalog = new catalog();
		$html = $catalog->login_advanced();
        $json = json_decode($html, true);

        print_r($json);
        // {"error":{"warning":"Warning: No match for E-Mail Address and\/or Password."}}
		// expect JSON Data

		$this->assertTrue(str_contains($html, "Success"), "Failed protected log in."); // Capital S
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