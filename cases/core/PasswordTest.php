<?php

namespace cases\core;

use PHPUnit\Framework\TestCase;

class PasswordTest extends TestCase
{
    public function testPasswordHash()
    {
        $password = "customer";
        $password_hash='$2y$10$h8G3KQAuKL7EaMCcOSFy1er80GOYvJJw3qEHNW8fwGfGqtQK3tJQ.';
    }
}
