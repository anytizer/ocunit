<?php
namespace cases\core;

use \Opencart\System\Library\Language;
use \PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{
    public function testLanguageLoaded()
    {
        $namespace = "catalog"; // "Opencart\\Catalog"; // "Opencart\\Catalog\\Controller\\Account"
        $code = "en-gb";
        $directory = DIR_OPENCART."admin/language/";
        $filename = "account/account";
        $prefix = "text_";

        $language = new Language($code);

        // Language
        # $language = new \Opencart\System\Library\Language($config->get('language_code'));
        #$language->addPath(DIR_LANGUAGE);
        #$language->load($config->get('language_code'));
        #$registry->set('language', $language);

        #$language->addPath($namespace, "");
        #$language->addPath($namespace, $directory);
        $language->addPath(DIR_LANGUAGE);
        $data = $language->load($filename, $prefix, $code);
        $text = $language->get("text_account");

        // @todo Remove this output
        #echo "\r\nOutput from: ", __CLASS__, "::", __METHOD__, "()\r\n";
        #print_r($language);
        #print_r($data);
        #print_r($text);

        $this->assertEquals("Account", $text, "Failed reading the language data.");
    }
}
