<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;
use \library\DatabaseExecuter as DatabaseExecuter;

class ExtensionsTest extends TestCase
{
	public function testCustomExtensionTablesPresent()
    {
        $admin = new DatabaseExecuter();
        $tables = $admin->tables();

        /**
         * Tables that are installed and used by third party extensions.
         */
        $searches = [
            "tw_price_history",
            "tw_manufacturer_prices",
        ];
        foreach($searches as $table)
        {
            $this->assertTrue(in_array($table, $tables), "Third party extension table `{$table}` is not available.");
        }
    }
}
