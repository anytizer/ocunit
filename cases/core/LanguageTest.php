<?php
namespace cases\core;

use \Opencart\System\Library\Language;
use \PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{
    public function setUp(): void
    {
        // $language->clear();
    }

    public function testLanguageLoaded()
    {
        $this->markAsRisky();

        // $file = $this->directory . $code . '/' . $filename . '.php';
        // $file = $this->path[$namespace] . $code . substr($filename, strlen($namespace)) . '.php';

        // language files attempted to load in home page
        //
        // catalog/language/en-gb/en-gb.php
        // catalog/language/en-gb/en-gb.php
        // extension/opencart/catalog/language/en-gb/module/category.php
        // catalog/language/en-gb/common/footer.php
        // catalog/language/en-gb/common/header.php
        // catalog/language/en-gb/common/language.php
        // catalog/language/en-gb/common/currency.php
        // catalog/language/en-gb/common/search.php
        // catalog/language/en-gb/common/cart.php
        // extension/opencart/catalog/language/en-gb/total/sub_total.php
        // extension/opencart/catalog/language/en-gb/total/credit.php
        // extension/opencart/catalog/language/en-gb/total/total.php
        // catalog/language/en-gb/common/menu.php

        $namespace = "catalog"; // "Opencart\\Catalog"; // "Opencart\\Catalog\\Controller\\Account"
        $code = "en-gb";
        $directory = DIR_OPENCART."admin/language/";
        $filename = "account/account";
        $prefix = "text_";

        $language = new Language($code);

        $language->addPath($namespace, "");
        $language->addPath($namespace, $directory);
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
