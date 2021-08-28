<?php

namespace cases\general;

use PHPUnit\Framework\TestCase;

class HtaccessTest extends TestCase
{
    public function testHtaccessDisablesDirectoryListingInFrontend()
    {
        $body = "Options -Indexes";
        $dothtaccess = DIR_OPENCART . ".htaccess";
        if (is_file($dothtaccess)) {
            $htaccess = file_get_contents($dothtaccess);
            $this->assertEquals($body, $htaccess, "Invalid .htaccess file in frontend.");
        } else {
            file_put_contents($dothtaccess, $body);
        }
    }

    public function testHtaccessDisablesDirectoryListingInAdmin()
    {
        $body = "Options -Indexes";
        $dothtaccess = DIR_OPENCART . "admin/.htaccess";
        if (is_file($dothtaccess)) {
            $htaccess = file_get_contents($dothtaccess);
            $this->assertEquals($body, $htaccess, "Invalid .htaccess file.");
        } else {
            file_put_contents($dothtaccess, $body);
        }
    }
}
