<?php

namespace ocunit\library;

class Session extends MySQLPDO
{
    public function truncate(): bool
    {
        $tables = [
            DB_PREFIX . "api_session",
            DB_PREFIX . "session",
        ];

        foreach ($tables as $table) {
            $this->raw("TRUNCATE TABLE `{$table}`;");
        }

        return count($tables);
    }
}
