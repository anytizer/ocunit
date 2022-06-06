<?php
namespace ocunit\business\cases;

use Exception;
use ocunit\library\Category;
use ocunit\library\MySQLPDO;
use ocunit\library\oc;
use PHPUnit\Framework\TestCase;
use function ocunit\_env;
use function ocunit\dt;

class CategoryTest extends TestCase
{
    public function testTruncateCategories()
    {
        $category = new Category();
        $category->truncate();

        $this->assertFalse(false);
    }

    public function testBuildCategories()
    {
        // from store > categories > products > images[]
        $category = new Category();
        $category->patch();

        $this->assertFalse(false);
    }

    /**
     * @throws Exception
     */
    /*
    public function testCreateCategoryDescriptions()
    {
        $pdo = new MySQLPDO();

        $pdo->raw("TRUNCATE TABLE `".DB_PREFIX."category_description`;");
        $pdo->raw("TRUNCATE TABLE `".DB_PREFIX."category`;");

        $categories = _env("stores.ini")["categories"]; // @todo Use ini/categories/*.md
        $stores = _env("stores.ini")["stores"];

        foreach($categories as $guid => $name)
        {
            foreach($stores as $store => $url)
            {
                #$store_id = $pdo->query("SELECT store_id FROM oc_store WHERE name")[0]["store_id"]; // get it

                #$sql = "INSERT INTO `".DB_PREFIX."category_to_store` (category_id, store_id) VALUES (:category_id, :store_id);";
                #$pdo->raw($sql, ["category_id" => , "store_id" => ]);
            }
        }

        $this->assertFalse(false);
    }*/
}