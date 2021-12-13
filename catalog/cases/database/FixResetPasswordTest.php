<?php

namespace cases\database;

use library\DatabaseExecutor;
use library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class FixResetPasswordTest extends TestCase
{
    public function testResetCustomerPasswords()
    {
        $pdo = new MySQLPDO();
        $dbx = new DatabaseExecutor();

        $customers = $dbx->customers();
        foreach ($customers as $customer) {
            $password = "password";
            $password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE `" . DB_PREFIX . "customer` SET `password`=:password WHERE `customer_id`=:customer_id;";
            $pdo->query($sql, [
                "password" => $password,
                "customer_id" => $customer["customer_id"],
            ]);
        }

        $this->assertNotEmpty($customers, "Customer passwords reset.");
    }
}
