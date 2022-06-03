<?php
namespace ocunit\library;

use Opencart\System\Engine\Config;
use Opencart\System\Engine\Event;
use Opencart\System\Engine\Loader;
use Opencart\System\Engine\Registry;
use Opencart\System\Library\Cart\User;
use Opencart\System\Library\DB;
use Opencart\System\Library\Language;
use Opencart\System\Library\Request;
use Opencart\System\Library\Response;
use Opencart\System\Library\Session;
use Opencart\System\Library\Template;
use Opencart\System\Library\Cache;
use Opencart\System\Library\Cart\Cart;
use Opencart\System\Library\Cart\Customer;
use Opencart\System\Library\Cart\Tax;
use Opencart\System\Library\Cart\Weight;
use Opencart\System\Library\Log;

use Exception;

/**
 * OpenCart Core system accessor
 */
class oc
{
    /**
     * @throws Exception
     */
    function must_require($directory = ".", $file = "config.php"): void
    {
        if (is_file("{$directory}/{$file}")) {
            require_once "{$directory}/{$file}";
        } else {
            throw new Exception("Cannot include: {$directory}/{$file}");
        }
    }

    /**
     * @throws Exception
     */
    function must_define($constant = ""): void
    {
        if (!defined($constant)) {
            throw new Exception("Must define: {$constant}");
        }
    }

    /**
     * @throws Exception
     */
    public function _registry(): Registry
    {
        global $autoloader;

        $registry = new Registry();
        $registry->set("autoloader", $autoloader);

        // Loader
        $loader = new Loader($registry);
        $registry->set("load", $loader);

        $config = new Config();
        $config->addPath(DIR_CONFIG);
        $config->load("default");
        $config->load(strtolower(APPLICATION));
        $config->set("application", APPLICATION);
        $registry->set("config", $config);

        $log = new Log($config->get("error_filename"));
        $registry->set("log", $log);

        $loader = new Loader($registry);
        $registry->set("load", $loader);

        $db = new DB("mysqli", DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE, DB_PORT);
        $registry->set("db", $db);

        $request = new Request();
        $registry->set("request", $request);

        $session = new Session($registry->config->get("session_engine"), $registry);
        $session->start();
        $registry->set("session", $session);

        $customer = new Customer($registry);
        $registry->set("customer", $customer);

        $cache = new Cache("file");
        $registry->set("cache", $cache);

        $tax = new Tax($registry);
        $registry->set("tax", $tax);

        $weight = new Weight($registry);
        $registry->set("weight", $weight);

        $cart = new Cart($registry);
        $registry->set("cart", $cart);

        return $registry;
    }
}

/**
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
$session->start();
$registry->set("session", $session);

$template = new Template($config->get("template_engine")); // engine: twig
$template->addPath(DIR_TEMPLATE);
$registry->set("template", $template);

$registry->set("user", new User($registry));
#$registry->set("request", new Request());
 */