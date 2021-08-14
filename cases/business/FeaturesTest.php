<?php
namespace cases\business;

use \PHPUnit\Framework\TestCase;

class FeaturesTest extends TestCase
{
    public function testDemoUserDoesNotSeeDeleteOption()
    {
        $this->markTestIncomplete("Permissions based menu links not implemented.");
    }

    public function testDemoUserDoesNotHavePermissionToModifyRecord()
    {
        $this->markTestIncomplete("Permissions checks not implemented.");
    }
}
