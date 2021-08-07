<?php
use \MySQLPDO as MySQLPDO;
use \anytizer\relay as relay;

/**
 * Catalog
 */
class catalog
{
    private $username = "test@example.com";
    private $password = "password";

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