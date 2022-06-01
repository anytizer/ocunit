<?php

namespace cases\general;

use PHPUnit\Framework\TestCase;

class HtaccessTest extends TestCase
{
    public function testHtaccessDisablesDirectoryListingInStore()
    {
        $expected_body = "Options -Indexes";
        $htaccess = $expected_body;
        $dot_htaccess_file = DIR_OPENCART . ".htaccess";
        if (is_file($dot_htaccess_file)) {
            $htaccess = file_get_contents($dot_htaccess_file);
        } else {
            file_put_contents($dot_htaccess_file, $htaccess);
        }

        $this->assertEquals($expected_body, $htaccess, "Invalid .htaccess file in store.");
    }

    public function testHtaccessDisablesDirectoryListingInAdmin()
    {
        $expected_body = "Options -Indexes";
        $htaccess = $expected_body;
        $dot_htaccess_file = DIR_OPENCART . "admin/.htaccess";
        if (is_file($dot_htaccess_file)) {
            $htaccess = file_get_contents($dot_htaccess_file);
        } else {
            file_put_contents($dot_htaccess_file, $htaccess);
        }

        $this->assertEquals($expected_body, $htaccess, "Invalid .htaccess file in admin.");
    }
}
