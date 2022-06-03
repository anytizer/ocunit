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
    public function testLanguageLoaded()
    {
        $code = "en-gb";
        $filename = "account/account";
        $filename = "catalog/information";
        $prefix = "text";

        #global $autoloader;
        #$registry = (new oc())->_registry();

        $config = new Config();


        $language = new Language($config->get("language_code"));
        $language->addPath(DIR_LANGUAGE);
        $language->load("extension/opencart/shipping/free");
        #print_r($language);
        $text = $language->get("text_home");

        $this->assertEquals("Home", $text, "Failed reading the language data.");
    }
}
