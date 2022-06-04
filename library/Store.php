<?php
namespace ocunit\library;

use \ocunit\library\MySQLPDO;

class Store extends MySQLPDO
{
    public function stores(): array
    {
        return $this->query("SELECT * FROM `" . DB_PREFIX . "store`;", []);
    }

    public function stores_delete(): bool
    {
        $this->raw("TRUNCATE TABLE `" . DB_PREFIX . "store`;", []);

        return true;
    }

    public function store_create($name, $url): bool
    {
        $sql = "INSERT INTO `oc_store` (`store_id`, `name`, `url`) VALUES (NULL, :name, :url);";
        $this->query($sql, ["name" => $name, "url" => $url]);

        return true;
    }
}
