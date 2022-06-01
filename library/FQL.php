<?php

namespace ocunit\library;

/**
 * Failsafe definition for DB Prefix
 */
if (!defined("DB_PREFIX")) {
    define("DB_PREFIX", "oc_");
}

class FQL
{
    public function read($sql_filename = ""): string
    {
        $sql = "";

        $fql_file = __OCUNIT_ROOT__ . "/sql/" . basename($sql_filename);
        if (is_file($fql_file)) {
            $sql = file_get_contents($fql_file);
            $sql = str_replace("oc_", DB_PREFIX, $sql);
        }

        return $sql;
    }
}