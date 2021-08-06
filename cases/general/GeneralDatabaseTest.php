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
    
    public function testSettingsCountMatch()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT COUNT(*) total FROM `".DB_PREFIX."setting`;";
        $data = $pdo->query($sql);
        $total = (int)$data[0]["total"];

        $records = 373;
        $this->assertEquals($records, $total);
    }

    public function testAtLeastOneLanguageIsActive()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT COUNT(*) total FROM `".DB_PREFIX."language`;";
        $data = $pdo->query($sql);
        $total = (int)$data[0]["total"];

        /**
         * Do NOT add multiple languages
         */
        $this->assertEquals(1, $total);
    }
}