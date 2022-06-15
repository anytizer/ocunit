<?php

namespace cases\business;

use PHPUnit\Framework\TestCase;

class WebTest extends TestCase
{
    public function testShowMessageToChooseStrongPassword()
    {
        // user registration page
        // password change page
        // password reset link email
        // modify the default theme page to insert extra message
        // @see https://github.com/opencart/opencart/blob/master/upload/catalog/view/template/account/password.twig
        $this->markTestIncomplete("Show a message to choose strong password.");
    }
}
