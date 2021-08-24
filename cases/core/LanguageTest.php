<?php
namespace cases\core;

use \Opencart\System\Library\Language;
use \PHPUnit\Framework\TestCase;

require_once DIR_OPENCART."system/library/language.php";

class LanguageTest extends TestCase
{
    public function testLanguageLoaded()
    {
        $namespace = "Opencart\\Catalog\\Controller\\Account";
        $prefix = "text_";
        $code = "en-gb";
        $filename = DIR_OPENCART."catalog/language/en-gb/account/login.php";

        $language = new Language($code);

        $language->addPath($namespace);
        $data_cart = $language->load($filename, $prefix, $code);
        $text_cart = $language->get("text_cart");

        print_r($language);
        print_r($data_cart);
        print_r($text_cart);

        $this->assertEquals("View Cart", $text_cart);
    }
}
