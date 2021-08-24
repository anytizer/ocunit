<?php
namespace cases\general;

use PHPUnit\Framework\TestCase;

class HtaccessTest extends TestCase
{
    public function testHtaccessDisablesDirectoryListingInFrontend()
    {
        $htaccess = file_get_contents(DIR_OPENCART.".htaccess");
        $this->assertEquals("Options -Indexes", $htaccess, "Invalid .htaccess file in frontend.");
    }

    public function testHtaccessDisablesDirectoryListingInAdmin()
    {
        // @todo Move admin/ using a variable
        $htaccess_admin = file_get_contents(DIR_OPENCART."admin/.htaccess");
        $this->assertEquals("Options -Indexes", $htaccess_admin, "Invalid .htaccess file in admin.");
    }
}
