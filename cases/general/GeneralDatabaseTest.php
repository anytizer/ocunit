<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \MySQLPDO as MySQLPDO;

class GeneralDatabaseTest extends TestCase
{
    public function testCanConnectToTheDatabase()
    {
        $pdo = new MySQLPDO();
        $this->assertNotNull($pdo, "Failed connecting to the database.");
    }
    
    public function testSettings()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT COUNT(*) total FROM oc_setting;";
        $data = $pdo->query($sql);
        $total = $data[0]["total"];

        $this->assertEquals(373, $total);
    }

    public function testAtLeastOneLanguageIsActive()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT COUNT(*) total FROM oc_language;";
        $data = $pdo->query($sql);
        $total = (int)$data[0]["total"];

        $this->assertEquals(1, $total);
    }

    public function testAtLeastOneStoreIsActive()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT COUNT(*) total FROM oc_store;";
        $total = (int)$pdo->query($sql)[0]["total"];

        $this->assertTrue($total > 0);
    }
}