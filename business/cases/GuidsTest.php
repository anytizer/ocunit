<?php

namespace ocunit\business\cases;

use anytizer\guid;
use PHPUnit\Framework\TestCase;

class GuidsTest extends TestCase
{
    public function testGenerateGuid()
    {
        $guid = guid::NewGuid();

        $this->assertEquals(36, strlen($guid));
    }

}