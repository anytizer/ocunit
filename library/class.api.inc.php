<?php

namespace library;

use anytizer\relay as relay;
use library\MySQLPDO as MySQLPDO;

class api
{
    public function list_all_api_users(): array
    {
        $pdo = new MySQLPDO();

        $apis_sql = "SELECT username FROM `" . DB_PREFIX . "api`;";
        $apis = $pdo->query($apis_sql);

        return $apis;
    }

    public function get_token_html(): string
    {
        global $configurations;
        $credentials = $configurations["credentials"]["api_valid"];

        $_GET = [
            "route" => "api/login",
        ];

        // @todo Read username and key from private config file that definitely should login.
        $_POST = [
            "username" => $credentials["username"],
            "key" => $credentials["password"],
        ];
        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);
        $html = $relay->fetch(HTTP_CATALOG . "index.php");

        return $html;
    }
}
