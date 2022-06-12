<?php

namespace cases\database;

use ocunit\library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class DatabaseIndexingTest extends TestCase
{
    public function testDropIndexes()
    {
        $pdo = new MySQLPDO();
        $pdo->raw("ALTER TABLE `".DB_PREFIX."setting` DROP INDEX `store_id`;");
    }

    public function testApplyIndexes()
    {
        $pdo = new MySQLPDO();
        $pdo->raw("ALTER TABLE `".DB_PREFIX."setting` ADD INDEX (`store_id`);");

        $this->fail();
    }

    public function testAnalyseIndexes()
    {
        $pdo = new MySQLPDO();

        $current_indexes_sql="SELECT TABLE_NAME, COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA=:table_schema ORDER BY TABLE_NAME, COLUMN_NAME;";
        $current_indexes = $pdo->query($current_indexes_sql, ["table_schema" => DB_DATABASE]);
        #print_r($current_indexes);
        /**
         *     [192] => Array
        (
        [TABLE_NAME] => tw_manufacturer_prices
        [COLUMN_NAME] => manufacturer_price_id
        )

        [193] => Array
        (
        [TABLE_NAME] => tw_manufacturer_prices
        [COLUMN_NAME] => product_id
        )

        [194] => Array
        (
        [TABLE_NAME] => tw_price_history
        [COLUMN_NAME] => history_id
        )

        [195] => Array
        (
        [TABLE_NAME] => tw_product_videos
        [COLUMN_NAME] => video_id
        )
         */

        $this->fail();
    }

}