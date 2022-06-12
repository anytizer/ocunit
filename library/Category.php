<?php

namespace ocunit\library;

use Exception;
use Parsedown;
use function ocunit\dt;

class Category extends MySQLPDO
{
    public function truncate(): int
    {
        $tables = [
            DB_PREFIX . "category",
            DB_PREFIX . "category_description",
            DB_PREFIX . "category_path",
            DB_PREFIX . "category_to_store",
        ];

        foreach ($tables as $table) {
            $this->raw("TRUNCATE TABLE `{$table}`;");
        }

        return count($tables);
    }

    /**
     * @throws Exception
     */
    public function patch()
    {
        $stores = (new Store())->stores();

        $categories = glob(__OCUNIT_ROOT__ . "/ini/categories/*/description.md");
        #print_r($categories);

        $parsedown = new Parsedown();

        foreach ($categories as $category_description_md) {
            $name = basename(dirname($category_description_md));
            $description = $parsedown->text(file_get_contents($category_description_md));
            #$name = substr(basename($category), 0, -3);
            $slug = (new \Slug())->create($name);


            $category_sql = "INSERT INTO `" . DB_PREFIX . "category` (`category_id`, `image`, `parent_id`, `top`, `column`, `sort_order`, `status`, `date_added`, `date_modified`) VALUES(:category_id, :image, :parent_id, :top, :column, :sort_order, :status, :date_added, :date_modified);";
            $category_data = [
                "category_id" => null,
                "image" => "",
                "parent_id" => "0",
                "top" => "1",
                "column" => "1",
                "sort_order" => "0",
                "status" => "1",
                "date_added" => dt(),
                "date_modified" => dt(),
            ];
            $this->raw($category_sql, $category_data);
            $category_id = $this->_id();

            $description_sql = "INSERT INTO `" . DB_PREFIX . "category_description` (
                category_id, language_id, name, description, meta_title, meta_description, meta_keyword
            ) VALUES (
                :category_id, :language_id, :name, :description, :meta_title, :meta_description, :meta_keyword
            );";
            $description_data = [
                "category_id" => $category_id,
                "language_id" => "1",
                "name" => $name,
                "description" => $description,
                "meta_title" => $name,
                "meta_description" => "",
                "meta_keyword" => ""
            ];
            $this->raw($description_sql, $description_data);


            // @todo Category Path
            $this->raw("INSERT INTO `" . DB_PREFIX . "category_path` SET `category_id` = :category_id, `path_id` = :path_id, `level` = 0;", ["category_id" => $category_id, "path_id" => $category_id]);


            foreach ($stores as $store) {
                $sql = "INSERT INTO `" . DB_PREFIX . "category_to_store` (`category_id`, `store_id`) VALUES (:category_id, :store_id);";
                $this->raw($sql, ["category_id" => $category_id, "store_id" => $store["store_id"]]);
            }

            $product = new Product();
            $product->patch($category_id, dirname($category_description_md));


//            $data = [
//                "parent_id" => 0,
//                "image" => "",
//                "top" => "1",
//                "column" => "1",
//                "sort_order" => "0",
//                "status" => "1",
//                "date_added" => dt(),
//                "date_modified" => dt(),
//
//                "category_description" => [1 => ["name" => $name, "description" => $description, "meta_title" => $name, "meta_description" => "", "meta_keyword" => ""]],
//                "category_seo_url" => [], // do NOT create seo urls
//            ];
//
//            #$category_id =$model->addCategory($data);
//
//            #echo "\r\n", $name, " -- ", $slug, " -- ", $description;
        }
    }
}