<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;
use \library\DatabaseExecutor;
use \library\MySQLPDO;
use \library\fql;
use \PDOException;

class ExtensionsTest extends TestCase
{
    public function testThirdPartyExtensionTablesArePresent()
    {
        $dbx = new DatabaseExecutor();
        $tables = $dbx->tables();

        $searches = [
            "tw_price_history",
            "tw_manufacturer_prices",
            "tw_product_videos",
            "tw_login_failures",
        ];

        foreach($searches as $table)
        {
            $this->assertTrue(in_array($table, $tables), "Third party extension table `{$table}` is not available.");
        }
    }

    public function testCreateMissingThirdPartyExtensionTables()
    {
        $this->expectException(PDOException::class);

        $pdo = new MySQLPDO();

        $files = [
            "tw_manufacturer_prices.sql",
            "tw_price_history.sql",
            "tw_product_videos.sql",
            "tw_login_failures.sql",
        ];

        foreach($files as $filename)
        {
            $sql = (new fql())->read($filename);
            $pdo->raw($sql);
        }
    }
}
