<?php

namespace ocunit\business;

use ocunit\library\Logo;
use PHPUnit\Framework\TestCase;

class LogoTest extends TestCase
{
    public function testChangeStoreLogo()
    {
        // 370 x 72
        // replace default logo with store logo
        // upload/image/catalog/opencart-logo.png
        // UPDATE `oc_setting` SET `value` = 'catalog/opencart-logo.png' WHERE `code` = 'config' AND `key` = 'config_logo';
        // logo file

        $logo = new Logo();

        $logo->delete_logos();

        $logo->create_logos();
        $logo->copy_logos();

        $logo->create_admin_logo();
        $logo->copy_admin_logos();

        #drop_store_logo();
        #copy_files();
        #update_store_logo();

        $this->fail();
    }
}
