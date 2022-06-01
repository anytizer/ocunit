<?php

namespace cases\business;

use ocunit\library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    /**
     * Currently accepting CAD only.
     */
    public function testSingleCurrencyOperation()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT * FROM `" . DB_PREFIX . "currency` WHERE `status`='1';";
        $data = $pdo->query($sql);

        global $configurations;

        $this->assertCount(1, $data, "Store should operate with single currency (non-international) on an initial phase.");
        $this->assertEquals($configurations["business_rules"]["default_currency"], $data[0]["code"], "Default currency must match business rule's currency.");
        //$this->assertEquals(1, (int)$data[0]["status"]);
        $this->assertEquals((int)"1.00000000", (int)$data[0]["value"]);
    }
}
