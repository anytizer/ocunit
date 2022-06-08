<?php

namespace cases\admin;

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
        //
    }

    public function testMysqlRemoteAccessToBeBlocked()
    {
        //
    }
}
