<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \library\MySQLPDO as MySQLPDO;
use \library\BusinessRules as BusinessRules;

class DatabaseTest extends TestCase
{
    public function testCanConnectToTheDatabase()
    {
        $pdo = new MySQLPDO();

        $this->assertNotNull($pdo, "Failed connecting to the database.");
    }
    
    public function testCountNumberOfSettings()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT COUNT(*) total FROM `".DB_PREFIX."setting`;";
        $data = $pdo->query($sql);
        $total = (int)$data[0]["total"];

        $business_rules = new BusinessRules();
        $this->assertEquals($business_rules->settings_count, $total, "The settings count has been modified.");
    }

    public function testOnlyOneLanguageIsActive()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT COUNT(*) total FROM `".DB_PREFIX."language`;";
        $data = $pdo->query($sql);
        $total = (int)$data[0]["total"];

        /**
         * Do NOT add multiple languages.
         * Default language should be eb-gb with id 1.
         */
        $this->assertEquals(1, $total);
    }

    public function testAdminPaginates100Items()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT * FROM `".DB_PREFIX."setting` WHERE `key`='config_pagination_admin';";
        $data = $pdo->query($sql);
        
        $this->assertEquals(100, (int)$data[0]["value"]);
    }

    /**
     * Currently accepting CAD only.
     */
    public function testSingleCurrencyOperation()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT * FROM `".DB_PREFIX."currency`;";
        $data = $pdo->query($sql);
        
        $this->assertCount(1, $data);
        $this->assertEquals("CAD", $data[0]["code"]);
        $this->assertEquals(1, (int)$data[0]["status"]);
        $this->assertEquals((int)"1.00000000", (int)$data[0]["value"]);
    }
}