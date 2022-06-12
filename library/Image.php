<?php

namespace ocunit\library;

class Image extends MySQLPDO
{
    public function truncate()
    {
        $tables = [
            DB_PREFIX . "product_image",
        ];

        foreach ($tables as $table) {
            $this->raw("TRUNCATE TABLE `{$table}`;");
        }

        return count($tables);
    }

    public function patch()
    {
        // catalog/demo/product.png
    }
}