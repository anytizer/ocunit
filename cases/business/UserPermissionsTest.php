<?php
namespace cases\business;

use \PHPUnit\Framework\TestCase;

class UserPermissionsTest extends TestCase
{
    public function testDemoUserDoesNotSeeDeleteOption()
    {
        // delete all demo users
        // create a demo user
        // login as a demo user
        // link to delete option is invisible
        $this->markTestIncomplete("Permissions based menu links not implemented.");
    }

    public function testDemoUserCannotDeleteRecord()
    {
        // login as a demo user
        // send delete request
        // delete operation is non-functional
        $this->markTestIncomplete("Permissions based controller/delete not implemented.");
    }

    public function testDemoUserDoesNotHavePermissionToModifyRecord()
    {
        // login as a demo user
        // send request to edit a record
        // data is not modified
        $this->markTestIncomplete("Permissions checks not implemented.");
    }
}
