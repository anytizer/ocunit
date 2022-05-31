<?php

namespace cases\database;

use ocunit\library\DatabaseExecutor;
use ocunit\library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class ChangeDatabaseValuesTest extends TestCase
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

        $this->assertNotEmpty($customers, "Customer passwords were not reset.");
    }

    /**
     * Reset customer email to something unuseful, so that they do not receive any emails in live mailbox.
     */
    public function testResetCustomerEmails()
    {
        $pdo = new MySQLPDO();
        $pdo->raw("UPDATE `" . DB_PREFIX . "customer` SET email=CONCAT(UUID(), '@example.com');", []);

        $total = $pdo->query("SELECT COUNT(*) total FROM oc_customer WHERE email NOT LIKE '%email.com';", [])[0]["total"];

        $this->assertEquals(0, $total, "Customer emails were not reset.");
    }
}
