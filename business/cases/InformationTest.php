<?php

namespace ocunit\business\cases;

use ocunit\library\Information;
use PHPUnit\Framework\TestCase;

class InformationTest extends TestCase
{
    public function testCreateCmsPages()
    {
        $information = new Information();
        $total = $information->truncate();

        $this->assertTrue($total >= 1);
    }

    public function CreateCmsPages()
    {
        $information = new Information();

        $total = $information->patch(__OCUNIT_ROOT__ . "/ini/information/*.md");

        $this->assertTrue($total > 0);
    }
}
