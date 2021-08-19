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
    private $username = "test@example.com";
    private $password = "password";

	/**
	 * Visit the home page
	 */
	public function browse_index()
	{
        $_GET = [
		];

		$_POST = [
		];

		$relay = new relay();
		$html = $relay->fetch(HTTP_SERVER."index.php");
        
        return $html;
	}

	public function browse_categories()
	{
		/**
		 * Used electronics, wires and parts
		 * @see http://localhost/opencart/upload/index.php?route=product/category&language=en-gb&path=66_63
		 */
		$_GET = [
			"route" => "product/category",
			"language" => "en-gb",
			"path" => "66_63",
		];
        $_POST = [];
		$relay = new relay();
		$relay->headers([
			"X-Protection-Token" => "",
		]);
		$this->html = $relay->fetch(HTTP_SERVER."index.php");
	}

	public function browse_product()
	{
		/**
		 * Micro SD Card 32GB
		 * @see http://localhost/opencart/upload/index.php?route=product/product&language=en-gb&path=66_63&product_id=82
		 */
		$_GET = [
			"route" => "product/product",
			"language" => "en-gb",
			"path" => "66_63",
			"product_id" => 82,
		];
        $_POST = [];
		$relay = new relay();
		$relay->headers([
			"X-Protection-Token" => "",
		]);
		$this->html = $relay->fetch(HTTP_SERVER."index.php");
	}

    /**
     * Open an arbitrary page for testing its HTML
     *
     * @param string $url
     * @return bool|string
     */
    public function open($url="https://...")
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

    public function login_simple()
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
		$html = $relay->fetch(HTTP_SERVER."index.php");
        
        return $html;
    }

    /**
     * @see // index.php?route=account/login|login&language=en-gb&login_token=5654914f48eccb41c6eb08fec3
     * @return bool|string
     */
    public function login_advanced()
    {
        $_GET = [
			"route" => "account/login|login",
			"language" => "en-gb",

			"login_token" => "5654914f48eccb41c6eb08fec3",
		];

		$_POST = [
			"email" => $this->username,
			"password" => $this->password,
		];

		$relay = new relay();
		$html = $relay->fetch(HTTP_SERVER."index.php");

        return $html;
    }
}
