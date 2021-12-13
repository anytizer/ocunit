<?php

namespace cases\general;

use PHPUnit\Framework\TestCase;

class HtaccessTest extends TestCase
{
    public function testHtaccessDisablesDirectoryListingInFrontend()
    {
        $expected_body = "Options -Indexes";
        $htaccess = $expected_body;
        $dothtaccessfile = DIR_OPENCART . ".htaccess";
        if (is_file($dothtaccessfile)) {
            $htaccess = file_get_contents($dothtaccessfile);
        } else {
            file_put_contents($dothtaccessfile, $htaccess);
        }

        $this->assertEquals($expected_body, $htaccess, "Invalid .htaccess file in front.");
    }

    public function testHtaccessDisablesDirectoryListingInAdmin()
    {
        $expected_body = "Options -Indexes";
        $htaccess = $expected_body;
        $dothtaccessfile = DIR_OPENCART . "admin/.htaccess";
        if (is_file($dothtaccessfile)) {
            $htaccess = file_get_contents($dothtaccessfile);
        } else {
            file_put_contents($dothtaccessfile, $htaccess);
        }

        $this->assertEquals($expected_body, $htaccess, "Invalid .htaccess file in admin.");
    }
}
