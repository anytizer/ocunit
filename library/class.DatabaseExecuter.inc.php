<?php
namespace library;

use \library\fql as fql;
use \library\MySQLPDO as MySQLPDO;

class DatabaseExecuter
{
    public function tables(): array
    {
        $pdo = new MySQLPDO();

        $tables_sql="SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=DATABASE();";
        $tables = $pdo->query($tables_sql);

        /**
         * Send a list of tables only
         */
        $names = [];
        foreach($tables as $table)
        {
            $names[] = $table["TABLE_NAME"];
        }

        return $names;
    }

    public function downloads(): array
    {
        $pdo = new MySQLPDO();

        $downloads_sql = (new fql())->read("downloads.sql");
        $downloads = $pdo->query($downloads_sql);

        return $downloads;
    }

    public function categories(): array
    {
        $pdo = new MySQLPDO();
		
		$sql = "SELECT category_id, image FROM `".DB_PREFIX."category`;";
		$categories = $pdo->query($sql);

        return $categories;
    }

    public function products(): array
    {
        $pdo = new MySQLPDO();
		
		$sql = "SELECT product_id, image FROM `".DB_PREFIX."product`;";
		$products = $pdo->query($sql);

        return $products;
    }

    public function inventories(): array
    {
        $pdo = new MySQLPDO();

        $sql = (new fql())->read("inventories.sql");
        $inventories = $pdo->query($sql);

        return $inventories;
    }

    public function taxes(): array
    {
        $pdo = new MySQLPDO();
        
        $taxes = [
            "0" => "None",
        ];
        $taxes_class_sql = "SELECT tax_class_id, title FROM `".DB_PREFIX."tax_class`;";
        $taxes_db = $pdo->query($taxes_class_sql);
        foreach($taxes_db as $tax)
        {
            $taxes[$tax["tax_class_id"]] = $tax["title"];
        }

        return $taxes;
    }

    public function lengths(): array
    {
        $pdo = new MySQLPDO();

        $lengths = [
            "0" => "None",
        ];
        $length_class_sql = "SELECT length_class_id, unit FROM `".DB_PREFIX."length_class_description` WHERE language_id=1;";
        $lengths_db = $pdo->query($length_class_sql);
        foreach($lengths_db as $length)
        {
            $lengths[$length["length_class_id"]] = $length["unit"];
        }

        return $lengths;
    }

    public function weights(): array
    {
        $pdo = new MySQLPDO();

        $weights = [
            "0" => "None",
        ];
        $weight_class_sql = "SELECT weight_class_id, unit FROM `".DB_PREFIX."weight_class_description` WHERE language_id=1;";
        $weights_db = $pdo->query($weight_class_sql);
        foreach($weights_db as $weight)
        {
            $weights[$weight["weight_class_id"]] = $weight["unit"];
        }

        return $weights;
    }
}
