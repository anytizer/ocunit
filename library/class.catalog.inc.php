<?php
namespace library;

use \library\MySQLPDO as MySQLPDO;
use \anytizer\relay as relay;

/**
 * Catalog
 */
class catalog
{
	/**
	 * Test customer
	 */
    private string $username;
    private string $password;

    public function __construct()
    {
        $br = new BusinessRules();
        $this->username = $br->credentials[4]->username;
        $this->password = $br->credentials[4]->password;
    }

	/**
	 * Visit the home page
	 */
	public function browse_index(): string
	{
	    $random = mt_rand(1000, 9999);

        $_GET = [
            "random" => $random,
		];

		$_POST = [
		];

		$relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);
		$html = $relay->fetch(HTTP_SERVER."index.php");
        
        return $html;
	}

    /**
     * Open an arbitrary simple page for testing its HTML in GET mode using full url
     *
     * @param string $url
     * @return string
     */
    public function open($url="https://..."): string
    {
        $_GET = [];
        $_POST = [];
        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);
        $html = $relay->fetch($url);

        return $html;
    }

    public function login_simple(): string
    {
        // http://localhost/opencart/upload/index.php?route=account/login|login&language=en-gb&login_token=d83e4e1f39e7859c30eddc998b

        $_GET = [
			"route" => "account/login|login",
			"language" => "en-gb",
		];

		$_POST = [
			"email" => $this->username,
			"password" => $this->password,
		];
		$relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);
		$html = $relay->fetch(HTTP_SERVER."index.php");
        
        return $html;
    }

    /**
     * @see // index.php?route=account/login|login&language=en-gb&login_token=5654914f48eccb41c6eb08fec3
     * @return string
     */
    public function login_advanced(): string
    {
        $_GET = [
			"route" => "account/login|login",
			"language" => "en-gb",

            // @todo Generate login token
			"login_token" => "5654914f48eccb41c6eb08fec3",
		];

		$_POST = [
			"email" => $this->username,
			"password" => $this->password,
		];

		$relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);
		$html = $relay->fetch(HTTP_SERVER."index.php");

        return $html;
    }

    public function lookup($post_query)
    {
        $page = "index.php";
        $_GET = $post_query["get"];
        $_POST = $post_query["post"];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch(HTTP_SERVER.$page);
        return $html;
    }
}
