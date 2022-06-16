<?php
namespace ocunit\catalog\cases\mail;

use PHPUnit\Framework\TestCase;

class SendgridTest extends TestCase
{
    public function testSendgridImplemented()
    {
        // https://sendgrid.com/pricing/
        // https://github.com/sendgrid/sendgrid-php
        // https://docs.sendgrid.com/api-reference/how-to-use-the-sendgrid-v3-api/authentication
        $this->markTestIncomplete("Must send emails using Sendgrid SMTP/API.");
    }
}
