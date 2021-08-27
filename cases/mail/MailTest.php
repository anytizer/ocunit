<?php
namespace cases\mail;

use \PHPUnit\Framework\TestCase;

class MailTest extends TestCase
{
    // SELECT * FROM oc_setting WHERE `key` LIKE '%_mail_%';

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

    public function testEmailBodyIsHtmlFormatted()
    {
        $this->markTestIncomplete("Email body is HTML formatted.");
    }

    public function testEmailIsWhitelisted()
    {
        $this->markTestIncomplete("Email is whitelisted.");
    }
}
