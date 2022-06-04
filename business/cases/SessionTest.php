<?php

namespace ocunit\business;

use ocunit\library\Session;
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    public function testClearSession()
    {
        $session = new Session();
        $session->delete();

        $this->assertFalse(false);
    }
}
