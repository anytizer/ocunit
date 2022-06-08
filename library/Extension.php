<?php

namespace ocunit\library;

class Extension extends MySQLPDO
{
    public function latest()
    {
        $sql = "INSERT INTO `oc_extension` SET `extension` = 'opencart', `type` = 'module', `code` = 'latest';";
        $sql = "INSERT INTO `oc_module` SET `name` = 'Latest Products', `code` = 'opencart.latest', `setting` = '{\"name\":\"Latest Products\",\"axis\":\"horizontal\",\"limit\":\"20\",\"width\":\"200\",\"height\":\"200\",\"status\":\"1\"}'";
    }
}