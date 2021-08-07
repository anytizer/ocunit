<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \library\MySQLPDO as MySQLPDO;

class GeneralMailTest extends TestCase
{
	public function testEmailSentFromWindows()
    {
        $this->markTestIncomplete("Email not sent from Windows.");
    }

    public function testSendgridImplemented()
    {
        $this->markTestIncomplete("Email using Sendgrid.");
    }
}
