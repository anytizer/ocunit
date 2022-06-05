<?php

namespace ocunit\business\cases;

use ocunit\library\MySQLPDO;
use PHPUnit\Framework\TestCase;
use function ocunit\_env;

class ManufacturerTest extends TestCase
{
    public function testRebuildManufactuer()
    {
        $manufacturers = _env("stores.ini")["manufacturers"];

        $pdo = new MySQLPDO();
        $pdo->raw("TRUNCATE TABLE `".DB_PREFIX."manufacturer`;");

        foreach($manufacturers as $manufacturer => $logo)
        {
            $pdo->raw("INSERT INTO `".DB_PREFIX."manufacturer` (manufacturer_id, name, image, sort_order) VALUES (
                :manufacturer_id, :name, :image, :sort_order
            )", [
                "manufacturer_id" => null,
                "name" => $manufacturer,
                "image" => $logo,
                "sort_order" => 0,
            ]);
        }

        $this->assertFalse(false);
    }
}