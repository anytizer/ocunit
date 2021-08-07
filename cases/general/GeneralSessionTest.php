<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \library\MySQLPDO;

class GeneralSessionTest extends TestCase
{
	public function testSessionsCleared()
	{
		$pdo = new MySQLPDO();

		$pdo->raw("DELETE FROM `".DB_PREFIX."session`;");

		$total = (int)$pdo->query("SELECT COUNT(*) total FROM `".DB_PREFIX."session`;")[0]["total"];
		$this->assertEquals(0, $total, "Session not cleared.");
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

		$sessions = $pdo->query("SELECT `data` FROM `".DB_PREFIX."session` WHERE `expire`>=NOW() LIMIT 1;");
		if(count($sessions))
		{
			$this->assertArrayHasKey("data", $sessions[0], "Session data is empty!");
		}
		else
		{
			$this->markTestIncomplete("Session does not have data!");
		}
	}
}