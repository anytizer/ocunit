<?php
namespace ocunit\library;

use ocunit\library\MySQLPDO;

class Logo extends MySQLPDO
{
    public function delete_logos()
    {
        $this->raw("DELETE FROM `" . DB_PREFIX . "setting` WHERE `key`='config_logo';");
    }

    public function create_logos()
    {
        $stores = $this->query("SELECT store_id, `name` FROM `" . DB_PREFIX . "store`;");

        // Because store id 0 (default) is not listed in the database!
        $stores[] = [
            "store_id" => "0",
            "name" => "Default",
        ];

        foreach($stores as $store)
        {
            $sql = "insert into `" . DB_PREFIX . "setting` (`setting_id`, `store_id`, `code`, `key`, `value`, `serialized`) values (NULL, :store_id, 'config', 'config_logo', :value, 0);";
            $this->raw($sql, [
                "store_id" => $store["store_id"],
                "value" => sprintf("catalog/%s/logo.png", (new \Slug())->create($store["name"])),
            ]);
        }
    }

    public function create_admin_logo()
    {
        // @todo Unable to customize admin logo
        // logo path is hard coded
        // http://localhost/oc/opencart/upload/admin/view/image/logo.png
        // Template: admin\view\template\common\header.twig
    }

    /**
     * @todo Copy logos
     */
    public function copy_logos()
    {
        // from ini path to logo file
        // if logo is missing, H1 tag is printed
        // https://github.com/opencart/opencart/blob/37f31394038b1da67e771a6550d6aac0e3bbc5d2/upload/catalog/view/template/common/header.twig#L75
    }

    public function copy_admin_logos()
    {
        //
    }
}