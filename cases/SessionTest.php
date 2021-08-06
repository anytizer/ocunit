<?php
namespace cases;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \MySQLPDO;

class SessionTest extends TestCase
{
	public function testSessionsAreActive()
	{
		$pdo = new MySQLPDO();
		$sessions = $pdo->query("SELECT `data` FROM oc_session WHERE `expire`>=NOW() LIMIT 1;");
		$this->assertArrayHasKey("data", $sessions[0], "Session data is empty!");
	}
}