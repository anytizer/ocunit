<?php

namespace cases\core;

use Opencart\Admin\Controller\Catalog\Information;
use Opencart\System\Engine\Registry;
use Opencart\System\Engine\Loader;
use Opencart\System\Engine\Event;
use Opencart\System\Engine\Config;
use Opencart\System\Library\DB;
use Opencart\System\Library\Language;
use Opencart\System\Library\Request;
use Opencart\System\Library\Response;
use Opencart\System\Library\Session;
use Opencart\System\Library\Template;
use Opencart\System\Library\Document;
use Opencart\System\Library\Url;
use Opencart\System\Library\Cart\User;
use PHPUnit\Framework\TestCase;

class LanguageTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testLanguageLoaded()
    {
        $code = "en-gb";
        $filename = "account/account";
        $filename = "catalog/information";
        $prefix = "text";

        global $autoloader;

        $registry = new Registry();
        $registry->set("autoloader", $autoloader);

        // Loader
        $loader = new Loader($registry);
        $registry->set("load", $loader);

        $event = new Event($registry);
        $registry->set("event", $event);

        $config = new Config();
        $config->addPath(DIR_CONFIG);
        $config->load("default");
        $config->load(strtolower(APPLICATION));
        $config->set("application", APPLICATION);
        $registry->set("config", $config);

        $language = new Language($code);
        $language->addPath(DIR_LANGUAGE);
        $language->load($code);
        $registry->set("language", $language);
        $data = $language->load($filename, $prefix, $code);
        #print_r($data);
        $text = $language->get("text_account");
        #$text = $language->get("text_home");

        $db = new DB("mysqli", DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        $registry->set("db", $db);

        // Response
        $response = new Response();
        $registry->set("response", $response);

        $request = new Request();
        $registry->set("request", $request);

        $session = new Session("db", $registry);
        $registry->set("session", $session);

        $template = new Template($config->get("template_engine")); // engine: twig
        $template->addPath(DIR_TEMPLATE);
        $registry->set("template", $template);

        $registry->set("user", new User($registry));
        #$registry->set("request", new Request());

        // @todo Remove this output
        #echo "\r\nOutput from: ", __CLASS__, "::", __METHOD__, "()\r\n";
        #print_r($language);
        #print_r($data);
        #print_r($text);

        ////////////////// /////////////////////////////////////////////////////////////////////////
//       $session->data["user_token"] = session_id();
//       $html = $this->controller_output($registry, $config);
//       echo $html;
        ///////////////////////////////////////////////////////////////////////////////////////////
        ///
        $this->assertEquals("Home", $text, "Failed reading the language data.");

    }

    private function controller_output($registry, $config): string
    {
        $controller = new Information($registry);
        //$controller->load(language("catalog/information");
        $registry->set("information", $controller);
        $registry->set("url", new Url($config->get("site_url")));
        $registry->set("document", new Document());
        $request = new \stdClass();
        $request->get = [];
        $request->post = [];
        //request->server = $this->request->server;
        $request->cookie = [];
        $registry->set("request", $request);

        $output = $controller->index();
        return $output;
    }
}
