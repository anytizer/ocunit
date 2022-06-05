<?php
namespace cases\business;

use ocunit\library\Admin;
use PHPUnit\Framework\TestCase;
use function ocunit\_env;

class CreateAdminTest extends TestCase
{
    public function testDeleteAdminUsers()
    {
        $admin = new Admin();
        $total = $admin->delete_all();

        $this->assertEquals(0, $total);
    }

    /**
     * @throws \Exception
     */
    public function testCreateAdminUser()
    {
        $user = _env("stores.ini")["admin"];

        $admin = new Admin();
        $user_id = $admin->create($user);

        $this->assertTrue($user_id != "");
    }
}