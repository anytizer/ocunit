<?php
namespace cases\database;

use library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class CountersTest extends TestCase
{
    private array $tables_counters = [];

    public function setUp(): void
    {
        global $configurations;

        foreach($configurations["tables_counters"] as $table => $counter)
        {
            $this->tables_counters[str_replace("oc_", DB_PREFIX, $table)] = $counter;
        }
    }

    public function testCountTruncatedTables()
    {
        $truncated = 0;

        $pdo = new MySQLPDO();

        if(__OCUNIT_EXECUTE_EXPENSIVE__)
        {
            foreach($this->tables_counters as $table => $total)
            {
                if($total===0)
                {
                    $pdo->query("TRUNCATE `{$table}`;");
                    ++$truncated;
                }
            }
        }

        $this->assertEquals(15, $truncated, "Mismatched truncated count.");
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
