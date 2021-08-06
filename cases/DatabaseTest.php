<?php
namespace cases;

use \PHPUnit\Framework\TestCase;
use \MySQLPDO as MySQLPDO;

class DatabaseTest extends TestCase
{
	public function testDatabaseConstantsDefined()
    {
        $this->assertTrue(defined('DB_DRIVER'));        
        $this->assertTrue(defined('DB_HOSTNAME'));
        $this->assertTrue(defined('DB_USERNAME'));
        $this->assertTrue(defined('DB_PASSWORD'));
        $this->assertTrue(defined('DB_DATABASE'));
        $this->assertTrue(defined('DB_PORT'));
        $this->assertTrue(defined('DB_PREFIX'));
    }

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
        $total = $data[0]['total'];

        $this->assertEquals(373, $total);
    }

    public function testAtLeastOneLanguageIsActive()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT COUNT(*) total FROM oc_language;";
        $data = $pdo->query($sql);
        $total = $data[0]['total'];

        $this->assertEquals(1, $total);
    }

    public function testAtLeastOneStoreIsActive()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT COUNT(*) total FROM oc_store;";
        $total = $pdo->query($sql)[0]['total'];

        $this->assertTrue($total > 0);
    }
}