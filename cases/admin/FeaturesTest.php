<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;

class FeaturesTest extends TestCase
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

    public function testDemoUserDoesNotSeeDeleteOption()
    {
        $this->markTestIncomplete("Permissions based menu links not implemented.");
    }

    public function testDemoUserDoesNotHavePermissionToModifyRecord()
    {
        $this->markTestIncomplete("Permissions checks not implemented.");
    }

    public function testCustomerApprovalRequiredForLogin()
    {
        $this->markTestIncomplete("Customer approval required for login.");
    }

    public function testLowOrderFeeApplies()
    {
        $this->markTestIncomplete("Low Order Fee to apply.");
    }

    public function testLowTaxRateInAlberta()
    {
        $this->markTestIncomplete("Taxes not calculated for Alberta Tax Zone.");
    }

    public function testFreeShippingInEdmonton()
    {
        $this->markTestIncomplete("Free shipping within city of store location.");
    }
}
