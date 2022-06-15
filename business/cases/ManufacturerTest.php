<?php

namespace ocunit\business\cases;

use ocunit\library\Manufacturer;
use ocunit\library\MySQLPDO;
use ocunit\library\Store;
use PHPUnit\Framework\TestCase;
use function ocunit\_env;

class ManufacturerTest extends TestCase
{
    public function testTruncateManufacturers()
    {
        $manufacturer = new Manufacturer();
        $total = $manufacturer->truncate();

        $this->assertTrue($total >= 1);
    }

    public function testRebuildManufacturers()
    {
        $manufacturers = _env("stores.ini")["manufacturers"];

        // @todo Instead of querying here, use Manufacturer class
        $pdo = new MySQLPDO();
        foreach ($manufacturers as $manufacturer => $logo) {
            $pdo->raw("INSERT INTO `" . DB_PREFIX . "manufacturer` (
            manufacturer_id, name, image, sort_order
            ) VALUES (
                :manufacturer_id, :name, :image, :sort_order
            );", [
                "manufacturer_id" => null,
                "name" => $manufacturer,
                "image" => $logo,
                "sort_order" => 0,
            ]);
        }

        $this->assertNotEmpty($manufacturers);
    }


    public function testAssignManufacturersToAllStores()
    {
        $pdo = new MySQLPDO();

        $s = new Store();
        $stores = $s->stores();

        $manufacturers = $pdo->query("SELECT * FROM `" . DB_PREFIX . "manufacturer`;", []);
        // $stores = $pdo->query("SELECT * FROM `" . DB_PREFIX . "store`;", []);
        // @todo Assign to default store too, with ID: 0.

        foreach ($manufacturers as $manufacturer) {
            foreach ($stores as $store) {
                $assign_sql = "INSERT INTO `" . DB_PREFIX . "manufacturer_to_store` (`manufacturer_id`, `store_id`) VALUES (:manufacturer_id, :store_id);";
                $pdo->raw($assign_sql, ["manufacturer_id" => $manufacturer["manufacturer_id"], "store_id" => $store["store_id"]]);
            }
        }

        $this->assertNotEmpty($stores);
        $this->assertNotEmpty($manufacturers);
    }
}