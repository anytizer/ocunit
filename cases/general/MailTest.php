<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \library\MySQLPDO as MySQLPDO;

class MailTest extends TestCase
{
	public function testEmailSentFromWindowsMachine()
    {
        /**
         * @todo Server should run under Windows
         */
        $this->markTestIncomplete("Email not sent from Windows.");
    }

    public function testEmailSentFromLinuxMachine()
    {
        /**
         * @todo Server should run under Linux
         */
        $this->markTestIncomplete("Email not sent from Linux.");
    }

    public function testSendgridImplemented()
    {
        $this->markTestIncomplete("Send email using Sendgrid SMTP/API.");
    }
}
