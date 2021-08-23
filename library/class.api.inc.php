<?php
namespace library;

use \library\MySQLPDO as MySQLPDO;
use \anytizer\relay as relay;

class api
{
    public function list_all_api_users()
    {
        $pdo = new MySQLPDO();

        $apis_sql="SELECT username FROM `".DB_PREFIX."api`;";
        $apis = $pdo->query($apis_sql);

        return $apis;
    }

    public function get_token_html()
	{
	    $br = new BusinessRules();

		$_GET = [
			"route" => "api/login",
		];

		// @todo Read username and key from private config file that definitely should login.
		$_POST = [
			"username" => $br->credentials[6]->username,
			"key" => $br->credentials[6]->password,
		];
		$relay = new relay();
		$relay->headers([
			"X-Protection-Token" => "",
		]);
		$html = $relay->fetch(HTTP_SERVER."index.php");
        
        return $html;
	}
}
