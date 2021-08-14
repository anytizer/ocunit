<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;

class FeaturesTest extends TestCase
{
    public function testDemoUserDoesNotSeeDeleteOption()
    {
        $this->markTestIncomplete("Permissions based menu links not implemented.");
    }

    public function testDemoUserDoesNotHavePermissionToModifyRecord()
    {
        $this->markTestIncomplete("Permissions checks not implemented.");
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
