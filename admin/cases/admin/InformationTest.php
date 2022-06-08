<?php

namespace ocunit\admin\cases\admin;

use ocunit\library\Information;
use PHPUnit\Framework\TestCase;
use function ocunit\_env;

class InformationTest extends TestCase
{
    public function testCreateCmsPages()
    {
        $information = new Information();
        $information->truncate();

        $total = $information->patch(__OCUNIT_ROOT__."/ini/information/*.md");

        $this->assertTrue($total > 0);
    }
}
