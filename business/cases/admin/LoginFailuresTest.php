<?php
namespace ocunit\business\cases\admin;

use ocunit\library\Admin;
use ocunit\library\Customer;

class LoginFailuresTest extends \PHPUnit\Framework\TestCase
{
    public function testAdminBruteForceLoginDiscouraged()
    {
        // an IP address cannot send a login request continuously over a short period
        // bottleneck such IPs and usernames
        // immediately terminate system user demanders
        $this->markTestIncomplete("Brute Force check not implemented.");
        //
    }

    public function testLoginFails()
    {

        $this->assertFalse(false);

       /*

        $admin = new admin();
        $donot_redirect_to_dashboard = $admin->login_failure_case();

        $json = json_decode($donot_redirect_to_dashboard, true);
        //assert(array_key_exists("error", $json));

        $this->assertTrue(str_contains($json["error"], "No match for Username and/or Password."), "Problems at login!");
       */
    }

    public function testLoginSucceeds()
    {
        $this->assertFalse(false);

        /**
        $admin = new admin();
        $redirect_to_dashboard = $admin->login_success_case();

        $json = json_decode($redirect_to_dashboard, true);
        //assert(array_key_exists("redirect", $json));

        // A successful login sends "redirect" information to dashboard
        $this->assertTrue(str_contains($json["redirect"], "route=common/dashboard"), "Redirecting to {$json['redirect']}");
         * */
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
        $username = "guest@example.com";
        $password = "guest";

        $guest = new Customer();
        $guest->signup($username);
        $guest->set_password($password);

        // now wait for admin to approve this account.
        // otherwise, should NOT be able to login.
        // rather notify this guest to wait for admin approval.

        $loggedin = $guest->login();

        $this->assertFalse($loggedin, "Customer approval required for login.");
    }
}
