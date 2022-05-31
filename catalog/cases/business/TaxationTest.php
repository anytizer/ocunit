<?php

namespace cases\business;

use PHPUnit\Framework\TestCase;

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

    public function testEcoTax()
    {
        $this->markTestIncomplete("Need to apply eco-tax.");
    }

    public function testGstTax()
    {
        $this->markTestIncomplete("GST calculation required.");
    }

    public function testHstTax()
    {
        $this->markTestIncomplete("HST calculation required.");
    }

    public function testPstTax()
    {
        $this->markTestIncomplete("PST calculation required.");
    }

    public function testQstTax()
    {
        $this->markTestIncomplete("QST calculation required.");
    }

    public function testValueAddedTax()
    {
        $this->markTestIncomplete("VAT calculation required.");
    }
}
