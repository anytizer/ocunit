<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;
use \library\DatabaseExecuter as DatabaseExecuter;

class ExtensionsTest extends TestCase
{
	public function testThirdPartyExtensionTablesArePresent()
    {
        $dbx = new DatabaseExecuter();
        $tables = $dbx->tables();

        $searches = [
            "tw_price_history",
            "tw_manufacturer_prices",
            "tw_product_videos",
        ];
        foreach($searches as $table)
        {
            $this->assertTrue(in_array($table, $tables), "Third party extension table `{$table}` is not available.");
        }
    }
}
