<?php
namespace ocunit\admin\cases\admin;

use PHPUnit\Framework\TestCase;

class OpenCartConfigurationsTest extends TestCase
{
    public function testDisplayTaxesSeparately()
    {
        // store taxes to be displayed separately in cart calculation
        # INSERT INTO `oc_setting` SET `store_id` = '0', `code` = 'config', `key` = 'config_tax', `value` = '1'
    }
}