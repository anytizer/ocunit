<?php
namespace cases\database;

use \PHPUnit\Framework\TestCase;
use \library\catalog;
use \library\MySQLPDO;

class SessionTest extends TestCase
{
	public function testSessionsAreCleared()
	{
		$pdo = new MySQLPDO();

		$pdo->raw("DELETE FROM `".DB_PREFIX."session`;");

		$sql = "SELECT COUNT(*) total FROM `".DB_PREFIX."session`;";
		$total = (int)$pdo->query($sql)[0]["total"];
		
		$this->assertEquals(0, $total, "Session not cleared.");
	}

	/**
	 * @todo Do NOT run against live database!
	 */
	public function testSessionIsCreated()
	{
		$pdo = new MySQLPDO();
		$pdo->raw("DELETE FROM `".DB_PREFIX."session`;");

		/**
		 * Just browse the home page
		 */
		$catalog = new catalog();
		$index = $catalog->browse_index();

		$sql = "SELECT COUNT(*) total FROM `".DB_PREFIX."session`;";
		$total = (int)$pdo->query($sql)[0]["total"];
		
		$this->assertEquals(1, $total, "Session not created.");
	}

    public function testAtLeastOneStoreIsActive()
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT COUNT(*) total FROM `".DB_PREFIX."store`;";
        $total = (int)$pdo->query($sql)[0]["total"];

        $this->assertTrue($total > 0);
    }

	public function testSessionsAreActive()
	{
		$pdo = new MySQLPDO();

		$sql = "SELECT `data` FROM `".DB_PREFIX."session` WHERE `expire`>=NOW() LIMIT 1;";
		$sessions = $pdo->query($sql);
		
		$this->assertArrayHasKey("data", $sessions[0], "Session data is empty!");
	}
}