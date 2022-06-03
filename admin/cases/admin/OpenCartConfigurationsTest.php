<?php
namespace ocunit\admin\cases\admin;

use ocunit\library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class OpenCartConfigurationsTest extends TestCase
{
    public function testDisplayTaxesSeparately()
    {
        // store taxes to be displayed separately in cart calculation
        # INSERT INTO `oc_setting` SET `store_id` = '0', `code` = 'config', `key` = 'config_tax', `value` = '1'
        $pdo = new MySQLPDO();

        $update_sql = "UPDATE oc_setting SET `value`=:value WHERE `code`='config' AND `key`='config_tax';";
        $pdo->query($update_sql, ["value" => "0"]);
        // 0: calculate subtotal without tax
        // 1: calculate subtotal with tax
    }
}