<?php

namespace ocunit\admin\cases\admin;

use ocunit\library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class MySQLConnectionTest extends TestCase
{
    public function testMysqlPersistentConnectionIsDisabled()
    {
        // SHOW VARIABLES LIKE '%innodb%';
        // innodb_buffer_pool_size
        // ini_get("mysqli.max_persistent") == -1
        // mysqli.allow_persistent = Off
        $this->fail();
    }

    public function testMysqlRemoteAccessToBeBlocked()
    {
        // assuming root connection
        $pdo = new MySQLPDO();

        $users = $pdo->query("SELECT `user`, `host` FROM mysql.user;", []);
        foreach ($users as $user) {
            $this->assertTrue($user["host"] != "%");
        }
    }
}
