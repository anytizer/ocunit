<?php

namespace ocunit\library;

use ocunit\library\FQL as FQL;
use ocunit\library\MySQLPDO as MySQLPDO;

/**
 * This is not a generic database wrapper.
 * Rather see: @MySQLPDO.
 *
 * It operates some known SQLs against your OpenCart database which MAY INCLUDE modifying the database.
 */
class DatabaseExecutor
{
    private MySQLPDO $pdo;

    public function __construct()
    {
        $this->pdo = new MySQLPDO();
    }

    public function triggers(): array
    {
        $triggers_sql = "SHOW TRIGGERS FROM `" . DB_DATABASE . "`;";
        $triggers = $this->pdo->query($triggers_sql, []);

        $names = [];
        foreach ($triggers as $trigger) {
            $names[] = $trigger["Trigger"];
        }

        return $names;
    }

    public function tables(): array
    {
        $tables_sql = "SHOW FULL TABLES FROM `" . DB_DATABASE . "` WHERE table_type = 'BASE TABLE';";
        $tables = $this->pdo->query($tables_sql, []);

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
        $sql = "SHOW CREATE TABLE `{$table}`;";
        $info = array_values($this->pdo->query($sql, [])[0])[1]; // ["Table" | "Create Table"]

        return $info;
    }

    public function statistics(): array
    {
        $sql = "SHOW TABLE STATUS FROM `" . DB_DATABASE . "` WHERE ENGINE IS NOT NULL;";
        return $this->pdo->query($sql);
    }

    public function downloads(): array
    {
        $downloads_sql = (new FQL())->read("downloads.sql");
        return $this->pdo->query($downloads_sql);
    }

    public function file_masks(): array
    {
        return $this->pdo->query("SELECT mask FROM `" . DB_PREFIX . "download`;", []);
    }

    public function downloadable_products(): array
    {
        global $configurations;

        $products_sql = (new FQL())->read("downloadable_products.sql");
        $products_sql = str_replace("10", $configurations["business_rules"]["downloadable_product_tax_class_id"], $products_sql);

        return $this->pdo->query($products_sql);
    }

    public function physical_products(): array
    {
        global $configurations;

        $products_sql = (new FQL())->read("physical_products.sql");
        $products_sql = str_replace("10", $configurations["business_rules"]["downloadable_product_tax_class_id"], $products_sql);

        $products = $this->pdo->query($products_sql);

        return $products;
    }

    public function categories(): array
    {
        $sql = "SELECT category_id, image FROM `" . DB_PREFIX . "category`;";
        return $this->pdo->query($sql, []);
    }

    public function products(): array
    {
        $sql = "SELECT product_id, image, price FROM `" . DB_PREFIX . "product`;";
        $products = $this->pdo->query($sql, []);

        return $products;
    }

    public function metrics(): array
    {
        $tax_class_id = _env("business_rules")["downloadable_product_tax_class_id"];

        $sql = "SELECT p.product_id, p.weight, p.weight_class_id, p.length, p.width, p.height, p.length_class_id FROM oc_product p WHERE tax_class_id!=:tax_class_id;";
        $products = $this->pdo->query($sql, [
            "tax_class_id" => $tax_class_id,
        ]);

        return $products;
    }

    public function inventories(): array
    {
        $sql = (new FQL())->read("inventories.sql");
        $inventories = $this->pdo->query($sql, []);

        return $inventories;
    }

    public function taxes(): array
    {
        $taxes = [
            "0" => "None",
        ];

        $taxes_class_sql = "SELECT tax_class_id, title FROM `" . DB_PREFIX . "tax_class`;";
        $taxes_db = $this->pdo->query($taxes_class_sql, []);
        foreach ($taxes_db as $tax) {
            $taxes[$tax["tax_class_id"]] = $tax["title"];
        }

        return $taxes;
    }

    public function lengths(): array
    {
        $lengths = [
            "0" => "None",
        ];

        $length_class_sql = "SELECT length_class_id, unit FROM `" . DB_PREFIX . "length_class_description` WHERE language_id=1;";
        $lengths_db = $this->pdo->query($length_class_sql, []);
        foreach ($lengths_db as $length) {
            $lengths[$length["length_class_id"]] = $length["unit"];
        }

        return $lengths;
    }

    public function weights(): array
    {
        $weights = [
            "0" => "None",
        ];

        $weight_class_sql = "SELECT weight_class_id, unit FROM `" . DB_PREFIX . "weight_class_description` WHERE language_id=1;";
        $weights_db = $this->pdo->query($weight_class_sql, []);
        foreach ($weights_db as $weight) {
            $weights[$weight["weight_class_id"]] = $weight["unit"];
        }

        return $weights;
    }

    public function customers(): array
    {
        $sql = "SELECT `customer_id`, email, `password` FROM `" . DB_PREFIX . "customer`;";
        $customers = $this->pdo->query($sql, []);
        return $customers;
    }
}
