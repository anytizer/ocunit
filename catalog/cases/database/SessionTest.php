<?php

namespace cases\database;

use ocunit\library\catalog as catalog;
use ocunit\library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        self::_truncate();
    }

    private static function _truncate()
    {
        $pdo = new MySQLPDO();
        $pdo->raw("TRUNCATE TABLE `" . DB_PREFIX . "session`;");
    }

    public function setUp(): void
    {
        $this->_delete();

        /**
         * Just browse the home page.
         * It should create a guest session in the database.
         */
        $catalog = new catalog();
        $index = $catalog->browse_index();
    }

    private function _delete()
    {
        $pdo = new MySQLPDO();
        $pdo->raw("DELETE FROM `" . DB_PREFIX . "session`;");
    }

    public function tearDown(): void
    {
        # $this->delete();
    }

    /**
     * @todo Do NOT run against the live database!
     */
    public function testSessionIsCreated()
    {
        $total = $this->_counter();

        $this->assertEquals(1, $total, "Invalid session data count: {$total}.");
    }

    private function _counter(): int
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT COUNT(*) total FROM `" . DB_PREFIX . "session`;";
        $total = (int)$pdo->query($sql)[0]["total"];

        return $total;
    }

    public function testAtLeastOneStoreIsActive()
    {
        $catalog = new catalog();
        $index1 = $catalog->browse_index();
        $index2 = $catalog->browse_index();

        $total = $this->_counter();

        $this->assertTrue($total > 0, "Session not created.");
    }
}