<?php
namespace cases\business;

use \PHPUnit\Framework\TestCase;

class TaxationTest extends TestCase
{
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
