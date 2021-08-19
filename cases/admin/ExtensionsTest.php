<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;
use \library\DatabaseExecuter as DatabaseExecuter;

class ExtensionsTest extends TestCase
{
	public function testCustomExtensionTablesPresent()
    {
        $dbx = new DatabaseExecuter();
        $tables = $dbx->tables();

        /**
         * Tables that are installed and used by third party extensions.
         */
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
