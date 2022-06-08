<?php

namespace ocunit\admin\cases\admin;

use ocunit\library\DatabaseExecutor;
use ocunit\library\FQL as FQL;
use ocunit\library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class ExtensionsTest extends TestCase
{
    public function testThirdPartyExtensionTablesArePresent()
    {
        $pdo = new MySQLPDO();
        $fql = new FQL();

        $dbx = new DatabaseExecutor();
        $tables = $dbx->tables();

        $extensions = [
            "tw_price_history" => "tw_price_history.sql",
            "tw_manufacturer" => "tw_manufacturer.sql",
            "tw_manufacturer_prices" => "tw_manufacturer_prices.sql",
            "tw_product_videos" => "tw_product_videos.sql",
            "tw_login_failures" => "tw_login_failures.sql",
            "tw_download_history" => "tw_download_history.sql", // different from oc_download_report
        ];

        $missing = 0;
        foreach ($extensions as $table => $filename) {
            if(!in_array($table, $tables)) {
                $sql = $fql->read($filename);
                $pdo->raw($sql, []);

                ++$missing;
            }
        }

        $this->assertEquals(0, $missing);
    }
}
