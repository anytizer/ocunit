<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;
use \MySQLPDO;

class AdminFeaturesTest extends TestCase
{
	public function testAdminBruteForceLoginDiscouraged()
    {
        $this->markTestIncomplete("Brute Force check not implemented.");
    }

    public function testLoginFails()
    {
        $this->markTestIncomplete("Failure case not implemented.");
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

    public function testDownloadablePrdouctsHasActiveDownloadableFile()
    {
        // for each downloadable product
        // download product is masked
        // download product is actively linked
        // customer who purchased a download can download
        // download links are protected with login
        $this->markTestIncomplete("Downloadables check not implemented.");
    }

    public function testDownloadCounter()
    {
        // download counter added right after a product is downloaded
        $this->markTestIncomplete("Downloadables statistics is not implemented.");
    }

    public function testCustomerApprovalRequiredForLogin()
    {
        $this->markTestIncomplete("Customer approval required for login.");
    }

    public function testLowTaxInAlberta()
    {
        $this->markTestIncomplete("Taxes not calculated for Alberta Tax Zone.");
    }

    public function testFreeShippingInEdmonton()
    {
        $this->markTestIncomplete("Free shipping within city of store location.");
    }
}
