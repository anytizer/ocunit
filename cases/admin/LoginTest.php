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
        // @todo supply valid username and password to make a login
        $this->markTestIncomplete("Login success case not implemented.");
    }

    public function testCustomerLoginFormHasCaptcha()
    {
        $this->markTestIncomplete("Login not protected with Captcha.");
    }
    
    public function testCustomerApprovalRequiredForLogin()
    {
        $this->markTestIncomplete("Customer approval required for login.");
    }

    public function testGuestCheckout()
    {
        $this->markTestIncomplete("Guest checkout disabled.");
    }
}
