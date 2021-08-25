<?php
namespace cases\general;

use PHPUnit\Framework\TestCase;

class PhpModulesTest extends TestCase
{
    /**
     * Minimum modules necessary to run OpenCart
     */
    public function testPhpModulesAvailable()
    {
        $this->assertTrue(function_exists("spl_autoload_register"), "Missing PHP extension: SPL");
        $this->assertTrue(function_exists("gd_info"), "Missing PHP extension: GD");
        $this->assertTrue(function_exists("curl_init"), "Missing PHP extension: cURL");
        $this->assertTrue(function_exists("mb_check_encoding"), "Missing PHP extension: MB String");

        /**
         * @see system/helper/general.php
         */
        $this->assertTrue(function_exists("random_bytes"), "Missing PHP function: random_bytes");
        $this->assertTrue(function_exists("openssl_random_pseudo_bytes"), "Missing PHP extension: OpenSSL");
    }
}
