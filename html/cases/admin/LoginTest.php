<?php

namespace cases\admin;

use ocunit\library\admin;
use ocunit\library\Customer;
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    public function testBlackListSystemUserDemanders()
    {
        $system_users = [
            "api",
            "admin",
            "customer",
            "guest",
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

        $this->markTestIncomplete("Block the IPs that are demanding system level user login.");
    }

    public function testAdminBruteForceLoginDiscouraged()
    {
        // an IP address cannot send a login request continuously over a short period
        // bottleneck such IPs and usernames
        // immediately terminate system user demanders
        $this->markTestIncomplete("Brute Force check not implemented.");
    }

    public function testLoginFails()
    {
        $admin = new admin();
        $donot_redirect_to_dashboard = $admin->login_failure_case();

        $json = json_decode($donot_redirect_to_dashboard, true);
        //assert(array_key_exists("error", $json));

        $this->assertTrue(str_contains($json["error"], "No match for Username and/or Password."), "Problems at login!");
    }

    public function testLoginSucceeds()
    {
        $admin = new admin();
        $redirect_to_dashboard = $admin->login_success_case();

        $json = json_decode($redirect_to_dashboard, true);
        //assert(array_key_exists("redirect", $json));

        /**
         * A successful login sends "redirect" information to dashboard
         */
        $this->assertTrue(str_contains($json["redirect"], "route=common/dashboard"), "Redirecting to {$json['redirect']}");
    }

    public function testCustomerLoginFormHasCaptcha()
    {
        // for valid username and password
        // and no captcha information
        // fail the login page
        $this->markTestIncomplete("Login not protected with Captcha.");
    }

    public function testCustomerApprovalRequiredForLogin()
    {
        // @todo Move to catalog
        // Create a customer
        // Try to login
        // Should fail

        $guest = new Customer();
        $guest->signup("guest@example.com");
        $guest->set_password("guest");
        $guest->login();

        $this->markTestIncomplete("Customer approval required for login.");
    }

    public function testGuestCheckout()
    {
        $guest = new Customer();
        $guest->build_cart();
        $guest->checkout();

        $this->markTestIncomplete("Guest checkout to be disabled.");
    }
}
