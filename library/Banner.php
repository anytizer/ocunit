<?php

namespace ocunit\library;

class Banner extends MySQLPDO
{
    public function truncate()
    {
        $tables = [
            DB_PREFIX . "banner",
            DB_PREFIX . "banner_image",
        ];

        foreach ($tables as $table) {
            $this->raw("TRUNCATE TABLE `{$table}`;");
        }

        return count($tables);
    }
}