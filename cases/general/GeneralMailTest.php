<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \library\MySQLPDO as MySQLPDO;

class GeneralMailTest extends TestCase
{
	public function testEmailSentFromWindowsMachine()
    {
        $this->markTestIncomplete("Email not sent from Windows.");
    }

    public function testEmailSentFromLinuxMachine()
    {
        $this->markTestIncomplete("Email not sent from Linux.");
    }

    public function testSendgridImplemented()
    {
        $this->markTestIncomplete("Send email using Sendgrid SMTP.");
    }
}
