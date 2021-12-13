<?php

namespace ocunit\library;

use anytizer\relay;

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

    private string $token;

    public function __construct()
    {
        global $configurations;
        $credentials = $configurations["credentials"]["customer_valid"];

        $this->username = $credentials["username"];
        $this->password = $credentials["password"];

        $this->token = "";
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
        $html = $relay->fetch(HTTP_CATALOG . "index.php");

        return $html;
    }

    /**
     * Open an arbitrary simple page for testing its HTML in GET mode using full url
     *
     * @param string $url
     * @return string
     */
    public function open($url = "https://..."): string
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

    public function lookup($post_query = []): string
    {
        $page = "index.php";
        $_GET = $post_query["get"];
        $_POST = $post_query["post"];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch(HTTP_CATALOG . $page);
        return $html;
    }

    public function login_simple(): string
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
        $relay->headers([
            "X-Protection-Token" => "",
        ]);
        $html = $relay->fetch(HTTP_CATALOG . "index.php");

        return $html;
    }

    /**
     * @return string
     * @see index.php?route=account/login|login&language=en-gb&login_token=71349433b0800cf219d769d35c
     * @see index.php?route=account/login&language=en-gb
     */
    public function login_advanced(): string
    {
        $this->token = $this->login_token();

        $_GET = [
            "route" => "account/login|login",
            "language" => "en-gb",
            "login_token" => $this->token,
        ];

        $_POST = [
            "email" => $this->username,
            "password" => $this->password,
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);
        $html = $relay->fetch(HTTP_CATALOG . "index.php");

        return $html;
    }

    private function login_token(): string
    {
        // open log out page first!
        $this->logout();

        // open login form page
        // grab token in the link
        // reuse token to login next time

        $_GET = [
            "route" => "account/login",
            "language" => "en-gb",
        ];

        $_POST = [];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);
        $html = $relay->fetch(HTTP_CATALOG . "index.php"); // when admin config file included

        $login_token = $this->_parse_login_token($html);
        return $login_token;
    }

    private function logout()
    {
        // http://localhost/oc/store/upload/index.php?route=account/logout&language=en-gb
        $_GET = [
            "route" => "account/logout",
            "language" => "en-gb",
        ];

        $_POST = [];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);
        $html = $relay->fetch(HTTP_CATALOG . "index.php");

        return $html;
    }

    private function _parse_login_token($html = ""): string
    {
        $matches = [];
        preg_match_all("#;login_token=(.*?)\"#", $html, $matches, PREG_PATTERN_ORDER);

        $login_token = $matches[1][0] ?? "INVALID-LOGIN-TOKEN"; // ??"00000000000000000000000000;

        return $login_token;
    }
}
