<?php

namespace ocunit\library;

class Manufacturer extends MySQLPDO
{
    public function truncate(): int
    {
        $tables = [
            DB_PREFIX . "manufacturer",
            DB_PREFIX . "manufacturer_to_store",
        ];

        foreach ($tables as $table) {
            $this->raw("TRUNCATE TABLE `{$table}`;");
        }

        return count($tables);
    }
}