<?php

namespace ocunit\library;

use Exception;

class Store extends MySQLPDO
{
    public function stores(): array
    {
        $stores = $this->query("SELECT * FROM `" . DB_PREFIX . "store`;", []);

        /**
         * Since many configurations have store_id = 0
         */
        $stores[] = [
            "store_id" => 0,
            "name" => "Default",
            "url" => "http://localhost/oc/opencart/upload/",
        ];

        return $stores;
    }

    public function truncate(): int
    {
        $tables = [
            DB_PREFIX . "store",
        ];

        foreach ($tables as $table) {
            $this->raw("TRUNCATE TABLE `{$table}`;");
        }

        return count($tables);
    }

    /**
     * @throws Exception
     * `oc_category_to_store`
     * `oc_information_to_store`
     * `oc_manufacturer_to_store`
     * `oc_product_to_store`
     * `oc_store`
     */
//    public function truncate(): bool
//    {
//        global $oc;
//        $oc_store = new \Opencart\Admin\Model\Setting\Store($oc->_registry());
//        $oc_store->getStores();
//
//
//        $this->raw("TRUNCATE TABLE `" . DB_PREFIX . "store`;", []);
//
//        return true;
//    }

    public function store_create($name = "", $url = "https://"): bool
    {
        $sql = "INSERT INTO `" . DB_PREFIX . "store` (`store_id`, `name`, `url`) VALUES (NULL, :name, :url);";
        $this->query($sql, ["name" => $name, "url" => $url]);

        return true;
    }
}
