<?php
namespace cases;

use \PHPUnit\Framework\TestCase;
use \MySQLPDO;

class AdminExtensionsTest extends TestCase
{
	public function testDatabaseConstantsDefined()
    {
        $pdo = new MySQLPDO();

        $tables_sql="SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=DATABASE();"; // DB_DATABASE
        $tables = $pdo->query($tables_sql);
        
        $names = [];
        foreach($tables as $table)
        {
            $names[] = $table["TABLE_NAME"];
        }

        /**
         * These tables are installed/used by third party extensions.
         */
        $searches = [
            "tw_price_history",
            "tw_manufacturer_prices",
        ];

        foreach($searches as $search)
        {
            $this->assertTrue(in_array($search, $names), "Table `{$search}` is not available");
        }
    }
}
