<?php

namespace ocunit\library;

class Store extends MySQLPDO
{
    public function stores(): array
    {
        $stores = $this->query("SELECT * FROM `" . DB_PREFIX . "store`;", []);
        $stores[] = [
            "store_id" => 0,
            "name" => "Default",
            "url" => "http://localhost/oc/opencart/upload/",
        ];

        return $stores;
    }

    public function truncate(): bool
    {
        $this->raw("TRUNCATE TABLE `" . DB_PREFIX . "store`;", []);

        return true;
    }

    public function store_create($name, $url): bool
    {
        $sql = "INSERT INTO `" . DB_PREFIX . "store` (`store_id`, `name`, `url`) VALUES (NULL, :name, :url);";
        $this->query($sql, ["name" => $name, "url" => $url]);

        return true;
    }
}
