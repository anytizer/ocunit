<?php
use \MySQLPDO as MySQLPDO;
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
}