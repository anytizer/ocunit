<?php

namespace cases\mail;

use PHPUnit\Framework\TestCase;

class MailTest extends TestCase
{
    // SELECT * FROM `oc_setting` WHERE  `key` like '%mail%';
    // config_email
    // config_mail_engine
    // config_mail_parameter
    // config_mail_smtp_hostname
    // config_mail_smtp_username
    // config_mail_smtp_password
    // config_mail_smtp_port
    // config_mail_smtp_timeout
    // config_mail_alert
    // config_mail_alert_email

    public function testMailEngineShouldBeSmtp()
    {
        // $config->get("config_mail_engine")
        // match: smtp
    }

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

    public function testHostingSmtpImplemented()
    {
        // on any generic smtp server
    }

    public function testEmailBodyIsHtmlFormatted()
    {
        $this->markTestIncomplete("Email body is HTML formatted.");
    }

    public function testEmailIsWhitelisted()
    {
        $this->markTestIncomplete("Email is whitelisted. Send an email. Confirm received.");
    }

    /**
     * @see https://github.com/opencart/opencart/blob/master/upload/admin/controller/mail/transaction.php
     */
    public function testServerConfigurations()
    {
        /**
         * $mail = new \Opencart\System\Library\Mail($this->config->get('config_mail_engine'));
         * $mail->parameter = $this->config->get('config_mail_parameter');
         * $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
         * $mail->smtp_username = $this->config->get('config_mail_smtp_username');
         * $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
         * $mail->smtp_port = $this->config->get('config_mail_smtp_port');
         * $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
         *
         * $mail->setTo($customer_info['email']);
         * $mail->setFrom($this->config->get('config_email'));
         * $mail->setSender($store_name);
         * $mail->setSubject($subject);
         * $mail->setHtml($this->load->view('mail/transaction', $data));
         * $mail->send();
         */
    }

    public function testAdminReceivesContactUsEmails()
    {
        // index.php?route=information/contact&language=en-gb
        // if this form is filled up, an email should generate to store admin.
    }
}
