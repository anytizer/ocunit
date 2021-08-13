<?php
namespace library;

use \library\MySQLPDO as MySQLPDO;
use \anytizer\relay as relay;

class api
{
    public function list_all_api()
    {
        $pdo = new MySQLPDO();

        $apis_sql="SELECT username FROM `".DB_PREFIX."api`;";
        $apis = $pdo->query($apis_sql);

        return $apis;
    }

    public function get_token_html()
	{
		$_GET = [
			"route" => "api/login",
		];

		// @todo Read username and key from private config file that definitely should login.
		$_POST = [
			"username" => "test1",
			"key" => "9acd35f146d93542c062e73697564373f0eac52ebf84ace1d9f59f2face8c5c4ed67d2939ebe86756e6fe4f1fbeb7bf3189d195883b8556b79339d9f3fbb518c32f9a72ab4226a495c2a6aa0f4508a7f8662d1d8fc7d5cfba81a89294556ba10338771247914482be7ce08e4c196af019802a8b69874a82f50863c7f89f64dcc",
		];
		$relay = new relay();
		$relay->headers([
			"X-Protection-Token" => "",
		]);
		$html = $relay->fetch(HTTP_SERVER."index.php");
        
        return $html;
	}
}