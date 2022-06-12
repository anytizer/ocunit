<?php

namespace ocunit\library;

class Session extends MySQLPDO
{
    public function truncate()
    {
        $this->query("TRUNCATE TABLE `" . DB_PREFIX . "session`;");
        return true;
    }
}
