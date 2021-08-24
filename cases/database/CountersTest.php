<?php
namespace cases\database;

use library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class CountersTest extends TestCase
{
    private array $tables_counters = [];
    private int $truncated = 0;

    public function setUp(): void
    {
        global $tables_counters;
        $this->tables_counters = $tables_counters;

        $this->truncated = 0;

        $pdo = new MySQLPDO();

        if(__OCUNIT_EXECUTE_EXPENSIVE__)
        {
            foreach($this->tables_counters as $table => $total)
            {
                if($total===0)
                {
                    $pdo->query("TRUNCATE `{$table}`;");
                    ++$this->truncated;
                }
            }
        }
    }

    public function testTotalRecordCounter()
    {
        $pdo = new MySQLPDO();

        foreach($this->tables_counters as $table => $total)
        {
            $sql = "SELECT COUNT(*) total FROM `{$table}`;";
            $total_db = $pdo->query($sql)[0]["total"];

            $this->assertEquals($total, $total_db, "Data counter mismatch in table: `{$table}`.");
        }
    }
}
