<?php

namespace ocunit\catalog\cases\report;

use ocunit\library\DatabaseExecutor;
use PHPUnit\Framework\TestCase;

class RecordsCountTest extends TestCase
{
    public function testRecordsCount()
    {
        $dbx = new DatabaseExecutor();
        $records = $dbx->statistics();

        $non_empty = [];
        $empty = [];

        foreach ($records as $info) {
            if ((int)$info["Rows"] > 0) {
                $non_empty[$info["Name"]] = $info["Rows"];
            } else {
                $empty[$info["Name"]] = $info["Rows"];
            }

            // @todo: split tests into tables that are always:
            // zero
            // fixed non-zero - eg: categories once setup
            // and variable counts as the website operates, eg. session data.
        }

        $this->_logTableRecords("tables-data.txt", $non_empty);
        $this->_logTableRecords("tables-no-data.txt", $empty);

        global $configurations;
        $this->assertCount((int)$configurations["statistics"]["non_empty"], $non_empty, "Non-Empty Tables count mismatch!");
        $this->assertCount((int)$configurations["statistics"]["empty"], $empty, "Empty Tables count mismatch!");
    }

    private function _logTableRecords($filename = "", $data = [])
    {
        $file = fopen(__OCUNIT_ROOT__ . "/logs/" . basename($filename), "wb+");
        foreach ($data as $table => $data_count) {
            fwrite($file, sprintf("%-30s - %d\r\n", substr($table, 0, 30), $data_count));
        }

        fclose($file);
    }
}
