<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    public function testBlackListSystemUserDemanders()
    {
        $system_users = [
            "admin",
            "customer",
            "api",
        ];

        $whitelisted_ip = [
            // @todo complete the IP address, removing * with a number
            "192.168.0.*",
            "192.168.1.*",
            "127.0.0.1",

            // more LAN IPs
            // more white listed IPV4s
            // more white listed IPV6s
        ];

        // if login request is made by one of these usernames
        // and the IP is not white listed,
        // block the user
        // block the user ip
        // report the user and ip
        // black list the user and ip

        $this->markTestIncomplete("Block the IPs that are demanding system user level login.");
    }

	public function testAdminBruteForceLoginDiscouraged()
    {
        // an IP address cannot send a login request continuously
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
