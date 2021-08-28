<?php
namespace library;

class credentials
{
    public string $username;
    public string $password;

    public string $token;

    public function __construct($username="", $password="")
    {
        $this->username = $username;
        $this->password = $password;

        $this->token = "";
    }
}