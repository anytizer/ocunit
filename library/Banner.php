<?php
namespace ocunit\library;

use ocunit\library\MySQLPDO;
use Parsedown;
use function ocunit\_env;

class Banner extends MySQLPDO
{
    public function truncate()
    {
        $tables = [
            DB_PREFIX."banner",
            DB_PREFIX."banner_image",
        ];

        foreach($tables as $table) {
            $this->raw("TRUNCATE TABLE `{$table}`;");
        }

        return count($tables);
    }
}