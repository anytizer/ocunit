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
        $this->assertTrue(function_exists("mb_check_encoding"), "Missing PHP extension: MB String");
        $this->assertTrue(function_exists("openssl_encrypt"), "Missing PHP extension: OpenSSL");

        /**
         * @see system/helper/general.php
         */
        $this->assertTrue(function_exists("random_bytes"), "Missing PHP function: random_bytes");
        $this->assertTrue(function_exists("openssl_random_pseudo_bytes"), "Missing PHP extension: OpenSSL");
    }

    public function testZendAssertions()
    {
        $assertion = ini_get("zend.assertions");
        $this->assertEquals(-1, $assertion, "Production value of Zend Assertion should be -1.");
    }

    /**
     * PHP include file configuration tests
     */
    public function testAllIncludedPathsExist()
    {
        $paths = explode(PATH_SEPARATOR, ini_get("include_path"));

        foreach ($paths as $path) {
            $this->assertTrue(is_dir($path), "Include path does not exist: {$path}.");
        }
    }
}
