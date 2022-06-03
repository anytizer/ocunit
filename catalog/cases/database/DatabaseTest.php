<?php

namespace cases\database;

use ocunit\library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public function testCanConnectToTheDatabase()
    {
        $pdo = new MySQLPDO();

        $this->assertNotNull($pdo, "Failed connecting to the database.");
    }

    public function testSingleCurrency()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT * FROM `" . DB_PREFIX . "currency` WHERE STATUS='1';";
        $data = $pdo->query($sql);

        $this->assertTrue(count($data) == 1, "Several currencies are active: Ensure that your business supports them.");
    }

    public function testOnlyOneLanguageIsActive()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT COUNT(*) total FROM `" . DB_PREFIX . "language`;";
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

        $sql = "SELECT * FROM `" . DB_PREFIX . "setting` WHERE `key`='config_pagination_admin';";
        $data = $pdo->query($sql);

        // @todo Load pagination size from config
        //global $configurations;
        //$admin_pagination = $configurations["settings"]["admin_pagination"];
        $admin_pagination = 100;

        $this->assertEquals($admin_pagination, (int)$data[0]["value"]);
    }
}