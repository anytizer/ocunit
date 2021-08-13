<?php
namespace library;

use \library\MySQLPDO as MySQLPDO;
use \anytizer\relay as relay;

class admin
{
    public function tables()
    {
        $pdo = new MySQLPDO();

        // DB_DATABASE
        $tables_sql="SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=DATABASE();";
        $tables = $pdo->query($tables_sql);

        return $tables;
    }
}
