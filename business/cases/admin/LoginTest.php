<?php
namespace ocunit\business\cases\admin;

use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    /**
     * Remove system like usernames from the OpenCart database.
     */
    private array $system_users = [
        "api",
        "admin",
        "customer",
        "guest",
        "demo",
        "super",
        "shop",
        "cart",
    ];

    public function testRemoveSystemUsers()
    {
        // delete system users from the system entirely.
        foreach($this->system_users as $user)
        {
            // permanently remove from the database!
        }

        $this->assertFalse(false);
    }

    public function testBlackListSystemUserDemanders()
    {

        $whitelisted_ip = [
            // @todo complete the IP address, removing * with a number
            "192.168.0.*",
            "192.168.1.*",
            "127.0.0.1",

            // more LAN IPs
            // more white listed IPV4s
            // more white listed IPV6s
        ];

        // if login request is made by one of these usernames
        // and the IP is not white listed,
        // block the user
        // block the user's ip
        // report the user and ip
        // black list the user and ip

        $this->markTestIncomplete("Block the IPs that are demanding system level user login.");
    }
}
