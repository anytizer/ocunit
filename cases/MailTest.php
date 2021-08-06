<?php
namespace cases;

use \PHPUnit\Framework\TestCase;
use \MySQLPDO as MySQLPDO;

class MailTest extends TestCase
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
