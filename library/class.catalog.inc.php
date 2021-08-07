<?php
namespace library;

use \library\MySQLPDO as MySQLPDO;
use \anytizer\relay as relay;

/**
 * Catalog
 */
class catalog
{
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
		$relay = new relay();
		$relay->headers([
			"X-Protection-Token" => "",
		]);
		$this->html = $relay->fetch(HTTP_SERVER."index.php");
	}

    public function login_simple()
    {
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

    public function login_protected()
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