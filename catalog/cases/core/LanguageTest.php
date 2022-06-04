<?php

namespace cases\core;

use Exception;
use ocunit\library\oc;
use Opencart\Admin\Controller\Catalog\Information;
use Opencart\System\Engine\Config;
use Opencart\System\Engine\Event;
use Opencart\System\Engine\Loader;
use Opencart\System\Engine\Registry;
use Opencart\System\Library\Cart\User;
use Opencart\System\Library\DB;
use Opencart\System\Library\Document;
use Opencart\System\Library\Language;
use Opencart\System\Library\Request;
use Opencart\System\Library\Response;
use Opencart\System\Library\Session;
use Opencart\System\Library\Template;
use Opencart\System\Library\Url;
use PHPUnit\Framework\TestCase;
use stdClass;

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
