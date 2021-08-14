<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
	public function testAdminBruteForceLoginDiscouraged()
    {
        $this->markTestIncomplete("Brute Force check not implemented.");
    }

    public function testLoginFails()
    {
        $this->markTestIncomplete("Admin login failure case not implemented.");
    }

    public function testLoginSucceeds()
    {
        $this->markTestIncomplete("Login success case not implemented.");
    }

    public function testLoginHasCaptcha()
    {
        $this->markTestIncomplete("Login not protected with Captcha.");
    }
}
