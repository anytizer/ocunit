<?php

namespace ocunit\library;

use ocunit\library\FQL as FQL;
use ocunit\library\MySQLPDO as MySQLPDO;

class DatabaseExecutor
{
    public function triggers(): array
    {
        $pdo = new MySQLPDO();

        $triggers_sql = "SHOW TRIGGERS FROM `" . DB_DATABASE . "`;";
        $triggers = $pdo->query($triggers_sql, []);

        $names = [];
        foreach ($triggers as $trigger) {
            $names[] = $trigger["Trigger"];
        }

        return $names;
    }

    public function tables(): array
    {
        $pdo = new MySQLPDO();

        $tables_sql = "SHOW FULL TABLES FROM `" . DB_DATABASE . "` WHERE table_type = 'BASE TABLE';";
        $tables = $pdo->query($tables_sql, []);

        /**
         * Send a list of tables only
         */
        $names = [];
        foreach ($tables as $table) {
            $names[] = array_values($table)[0]; // `Tables_in_DATABASE` => 0
        }

        return $names;
    }

    public function info($table = ""): string
    {
        $pdo = new MySQLPDO();

        $sql = "SHOW CREATE TABLE `{$table}`;";
        $info = array_values($pdo->query($sql, [])[0])[1]; // ["Table" | "Create Table"]

        return $info;
    }

    public function statistics(): array
    {
        $pdo = new MySQLPDO();

        $sql = "SHOW TABLE STATUS FROM `" . DB_DATABASE . "` WHERE ENGINE IS NOT NULL;";
        return $pdo->query($sql);
    }

    public function downloads(): array
    {
        $pdo = new MySQLPDO();

        $downloads_sql = (new FQL())->read("downloads.sql");
        return $pdo->query($downloads_sql);
    }

    public function downloadable_products(): array
    {
        global $configurations;
        $pdo = new MySQLPDO();

        $products_sql = (new FQL())->read("downloadable_products.sql");
        $products_sql = str_replace("10", $configurations["business_rules"]["downloadable_product_tax_class_id"], $products_sql);

        return $pdo->query($products_sql);
    }

    public function physical_products(): array
    {
        global $configurations;
        $pdo = new MySQLPDO();

        $products_sql = (new FQL())->read("physical_products.sql");
        $products_sql = str_replace("10", $configurations["business_rules"]["downloadable_product_tax_class_id"], $products_sql);

        $products = $pdo->query($products_sql);

        return $products;
    }

    public function categories(): array
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT category_id, image FROM `" . DB_PREFIX . "category`;";
        return $pdo->query($sql, []);
    }

    public function products(): array
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT product_id, image, price FROM `" . DB_PREFIX . "product`;";
        $products = $pdo->query($sql, []);

        return $products;
    }

    public function inventories(): array
    {
        $pdo = new MySQLPDO();

        $sql = (new FQL())->read("inventories.sql");
        $inventories = $pdo->query($sql, []);

        return $inventories;
    }

    public function taxes(): array
    {
        $pdo = new MySQLPDO();

        $taxes = [
            "0" => "None",
        ];
        $taxes_class_sql = "SELECT tax_class_id, title FROM `" . DB_PREFIX . "tax_class`;";
        $taxes_db = $pdo->query($taxes_class_sql, []);
        foreach ($taxes_db as $tax) {
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
        $length_class_sql = "SELECT length_class_id, unit FROM `" . DB_PREFIX . "length_class_description` WHERE language_id=1;";
        $lengths_db = $pdo->query($length_class_sql, []);
        foreach ($lengths_db as $length) {
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
        $weight_class_sql = "SELECT weight_class_id, unit FROM `" . DB_PREFIX . "weight_class_description` WHERE language_id=1;";
        $weights_db = $pdo->query($weight_class_sql, []);
        foreach ($weights_db as $weight) {
            $weights[$weight["weight_class_id"]] = $weight["unit"];
        }

        return $weights;
    }

    public function customers(): array
    {
        $pdo = new MySQLPDO();

        $sql = "SELECT `customer_id`, email, `password` FROM `" . DB_PREFIX . "customer`;";
        $customers = $pdo->query($sql, []);
        return $customers;
    }
}
