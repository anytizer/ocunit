<?php

namespace cases\admin;

use ocunit\library\MySQLPDO;
use Opencart\System\Library\DB\PDO;
use PHPUnit\Framework\TestCase;

class SettingsTest extends TestCase
{
    public function testDatabaseConstantsDefined()
    {
        $this->assertTrue(defined("DB_DRIVER"));
        $this->assertTrue(defined("DB_HOSTNAME"));
        $this->assertTrue(defined("DB_USERNAME"));
        $this->assertTrue(defined("DB_PASSWORD"));
        $this->assertTrue(defined("DB_DATABASE"));
        $this->assertTrue(defined("DB_PORT"));
        $this->assertTrue(defined("DB_PREFIX"));
    }

    public function testDbConstantsYieldConnection()
    {
        $pdo = new PDO(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        $connected = $pdo->isConnected();

        $this->assertTrue($connected);
    }

    public function testOtherSettingsDefined()
    {
        $this->assertTrue(defined("HTTP_CATALOG"));
        $this->assertTrue(defined("OPENCART_SERVER"));
    }

    public function testMysqlPConnectIsDisabled()
    {
        // SHOW VARIABLES LIKE '%innodb%';
        // innodb_buffer_pool_size
        $this->fail();
    }

    public function testMysqlRemoteAccessToBeBlocked()
    {
        $pdo = new MySQLPDO(); // assuming root connection
        $users = $pdo->query("SELECT `user`, `host` FROM mysql.user;", []);
        foreach ($users as $user) {
            $this->assertTrue($user["host"] != "%");
        }
        //$this->fail();
    }
}
