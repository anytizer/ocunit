<?php

namespace ocunit\library;

use anytizer\relay as relay;
use Opencart\Admin\Model\User\User;
use Opencart\Catalog\Controller\Account\Password;
use Opencart\System\Library\Encryption;

class Session extends MySQLPDO
{
    public function delete()
    {
        $this->query("TRUNCATE TABLE `".DB_PREFIX."session`;");
        return true;
    }
}
