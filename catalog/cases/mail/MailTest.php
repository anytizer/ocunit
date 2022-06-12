<?php

namespace cases\mail;

use PHPUnit\Framework\TestCase;

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
         * @todo Important: Server should run under Linux only!
         */
        $this->markTestIncomplete("Email not sent from Linux.");
    }

    public function testSendgridImplemented()
    {
        $this->markTestIncomplete("Must send emails using Sendgrid SMTP/API.");
    }

    public function testEmailBodyIsHtmlFormatted()
    {
        $this->markTestIncomplete("Email body is HTML formatted.");
    }

    public function testEmailIsWhitelisted()
    {
        $this->markTestIncomplete("Email is whitelisted. Send an email. Confirm received.");
    }

    // https://github.com/opencart/opencart/blob/master/upload/admin/controller/mail/transaction.php
    public function testServerConfigurations()
    {
        /**
        $mail = new \Opencart\System\Library\Mail($this->config->get('config_mail_engine'));
        $mail->parameter = $this->config->get('config_mail_parameter');
        $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
        $mail->smtp_username = $this->config->get('config_mail_smtp_username');
        $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
        $mail->smtp_port = $this->config->get('config_mail_smtp_port');
        $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

        $mail->setTo($customer_info['email']);
        $mail->setFrom($this->config->get('config_email'));
        $mail->setSender($store_name);
        $mail->setSubject($subject);
        $mail->setHtml($this->load->view('mail/transaction', $data));
        $mail->send();
        */
    }
}
