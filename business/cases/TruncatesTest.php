<?php

namespace ocunit\business\cases;

use ocunit\library\MySQLPDO;
use PHPUnit\Framework\TestCase;
use function ocunit\_env;

class TruncatesTest extends TestCase
{
    public function testTruncateTables()
    {
        $pdo = new MySQLPDO();

        $truncates = _env("config.ini")["truncates"];

        foreach($truncates as $table => $info)
        {
            $pdo->raw("TRUNCATE TABLE `{$table}`;");
        }

        /**
         * @todo Individual components may truncate their own tables.
         */
        $this->fail();
    }
}