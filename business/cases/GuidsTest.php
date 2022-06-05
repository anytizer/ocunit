<?php
namespace ocunit\business\cases;

use anytizer\guid;
use PHPUnit\Framework\TestCase;

class GuidsTest extends TestCase
{
    public function testGenerateGuids()
    {
        $number = 10;
        for($i=1; $i<=$number; ++$i)
        {
            echo "\r\n", guid::NewGuid();
        }
    }
}