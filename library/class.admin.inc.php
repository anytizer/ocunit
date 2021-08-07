<?php
namespace library;

use \library\MySQLPDO as MySQLPDO;
use \anytizer\relay as relay;

class admin
{
    public function tables()
    {
        $pdo = new MySQLPDO();

        $tables_sql="SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=DATABASE();"; // DB_DATABASE
        $tables = $pdo->query($tables_sql);

        return $tables;
    }
}
