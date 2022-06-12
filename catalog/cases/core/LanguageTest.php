<?php

namespace cases\core;

use Exception;
use Opencart\System\Library\Language;
use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAdminLanguageLoaded()
    {
        $language = new Language("en-gb");
        $language->addPath(DIR_LANGUAGE); // from admin path
        $language->load("catalog/attribute_group");

        $text = $language->get("heading_title");

        $this->assertEquals("Attribute Groups", $text, "Failed reading the language data.");
    }

    // it tests 2 different ways of accessing language variables
    public function testStoreLanguageLoaded()
    {
        // to load DIR_LANGUAGE of store
        $path = str_replace("/admin", "/catalog", DIR_LANGUAGE);

        $language = new Language("en-gb");
        $language->addPath($path); // from store frontend path
        $language->load("account/account");

        $text = $language->get("heading_title");

        $this->assertEquals("Account", $language->all("text")["account"]);
        $this->assertEquals("My Account", $text, "Failed reading the language data.");
    }
}
