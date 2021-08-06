<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \MySQLPDO;

class GeneralSessionTest extends TestCase
{
	public function testSessionsCleared()
	{
		$pdo = new MySQLPDO();
		$pdo->raw("DELETE FROM oc_session;");

		$total = (int)$pdo->query("SELECT COOUNT(*) total FROM oc_session;")[0]["total"];
		$this->assertEquals(0, $total, "Session not cleared.");
	}

	public function testSessionsAreActive()
	{
		$pdo = new MySQLPDO();
		$sessions = $pdo->query("SELECT `data` FROM oc_session WHERE `expire`>=NOW() LIMIT 1;");
		$this->assertArrayHasKey("data", $sessions[0], "Session data is empty!");
	}
}