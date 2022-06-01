<?php

namespace cases\core;

use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function testPasswordHash()
    {
        /**
         * From oc_customer
         */
        $password_plain = "customer";
        $password_hash = '$2y$10$h8G3KQAuKL7EaMCcOSFy1er80GOYvJJw3qEHNW8fwGfGqtQK3tJQ.';

        $this->assertTrue(password_verify($password_plain, $password_hash), "Failed matching password hash.");
    }
}
