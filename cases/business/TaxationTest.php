<?php
namespace cases\business;

use \PHPUnit\Framework\TestCase;

class TaxationTest extends TestCase
{
    public function testLowOrderFeeApplies()
    {
        $this->markTestIncomplete("Low order fee to apply.");
    }

    public function testLowTaxRateInAlberta()
    {
        $this->markTestIncomplete("Low tax rate for Alberta Tax Zone.");
    }

    public function testGstTax()
    {
        $this->markTestIncomplete("GST Calculation required.");
    }

    public function testHstTax()
    {
        $this->markTestIncomplete("HST Calculation required.");
    }
}
