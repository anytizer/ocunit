<?php
namespace ocunit\business\cases;

use Exception;
use ocunit\library\MySQLPDO;
use ocunit\library\oc;
use Opencart\Admin\Model\Catalog\Category;
use function ocunit\_env;
use function ocunit\dt;

class CategoryDescriptionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @throws Exception
     */
    public function testCreateCategoryDescriptions()
    {
        $pdo = new MySQLPDO();

        $pdo->raw("TRUNCATE TABLE `".DB_PREFIX."category_description`;");
        $pdo->raw("TRUNCATE TABLE `".DB_PREFIX."category`;");

        $categories = _env("stores.ini")["categories"];
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

        $registry = (new oc())->_registry();
        $category = new Category($registry);

        foreach($categories as $guid => $name)
        {
            $data = [
                "parent_id" => 0,
                "image" => "",
                "top" => "1",
                "column" => "1",
                "sort_order" => "0",
                "status" => "1",
                "date_added" => dt(),
                "date_modified" => dt(),

                "category_description" => [1 => ["name" => $name, "description" => "", "meta_title" => $name, "meta_description" => "", "meta_keyword" => ""]],
                "category_seo_url" => [], // do NOT create seo urls
            ];

            $category_id = $category->addCategory($data);

        }

        $this->assertFalse(false);
    }
}