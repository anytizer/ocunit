<?php

namespace ocunit\library;

use Slug;
use function ocunit\dt;

class Product extends MySQLPDO
{
    public function truncate()
    {
        $tables = [
            DB_PREFIX . "product",
            DB_PREFIX . "product_to_download",
            DB_PREFIX . "product_to_category",
            DB_PREFIX . "product_description",
            DB_PREFIX . "product_image",
            DB_PREFIX . "product_to_store",
            DB_PREFIX . "product_special",
            DB_PREFIX . "product_to_layout",
        ];

        foreach ($tables as $table) {
            $this->raw("TRUNCATE TABLE `{$table}`;");
        }

        return count($tables);
    }

    public function patch($category_id = 0, $directory = "/ini/categories/*/*")
    {
        $toucher = new FileToucher();

        $s = new Store();
        $stores = $s->stores();

        $product_description_mds = glob("{$directory}/*/description.md");

        foreach ($product_description_mds as $product_description_md) {
            $path = dirname($product_description_md);
            $name = basename($path);
            $slug = (new Slug())->create($name);
            $description = file_get_contents($product_description_md);

            $price_file = $path . "/price.txt";
            $toucher->touch($price_file);
            $price = is_file($price_file) ? file_get_contents($price_file) : 9999.99;

            $mprice_file = $path . "/mprice.txt";
            $toucher->touch($mprice_file);
            $mprice = is_file($mprice_file) ? file_get_contents($mprice_file) : 9999.99;

            // @todo Use .ini file for product details

            /**
             * # data gathered so far
             */
            /**
             * echo "\r\n", $directory;
             * echo "\r\n", $name, " - ", $slug, " - ", $product_description_md;
             * echo "\r\n", $description;
             * echo "\r\n", $price, " | ", $mprice;
             * echo "\r\n";
             */

            $sql_product_add = "insert into `" . DB_PREFIX . "product` (
            `product_id`, `master_id`,
            `model`, `sku`, `upc`, `ean`, `jan`, `isbn`, `mpn`,
            `location`, `variant`, `override`, `quantity`, `stock_status_id`, `image`,
            `manufacturer_id`, `shipping`, `price`, `points`, `tax_class_id`, `date_available`,
            `weight`, `weight_class_id`, `length`, `width`, `height`, `length_class_id`,
            `subtract`, `minimum`, `sort_order`, `status`, `viewed`, `date_added`, `date_modified`
            ) values (
            :product_id, :master_id,
            :model, :sku, :upc, :ean, :jan, :isbn, :mpn,
            :location, :variant, :override, :quantity, :stock_status_id, :image,
            :manufacturer_id, :shipping, :price, :points, :tax_class_id, :date_available,
            :weight, :weight_class_id, :length, :width, :height, :length_class_id,
            :subtract, :minimum, :sort_order, :status, :viewed, :date_added, :date_modified
            );";
            $data_product = [
                "product_id" => null,
                "master_id" => "0",
                "model" => "MODEL-001", # @todo Require product model
                "sku" => "",
                "upc" => "",
                "ean" => "",
                "jan" => "",
                "isbn" => "",
                "mpn" => "",
                "location" => "",
                "variant" => "",
                "override" => "",
                "quantity" => "99",
                "stock_status_id" => "1", // fix
                "image" => "",
                "manufacturer_id" => "0",
                "shipping" => "0",
                "price" => (float)$price ?? 99.99,
                "points" => "0",
                "tax_class_id" => "0",
                "date_available" => dt(),
                "weight" => "0",
                "weight_class_id" => "0",
                "length" => "0",
                "width" => "0",
                "height" => "0",
                "length_class_id" => "0",
                "subtract" => "0",
                "minimum" => "1",
                "sort_order" => "0",
                "status" => "1",
                "viewed" => "0",
                "date_added" => dt(),
                "date_modified" => dt(),
            ];

            $this->raw($sql_product_add, $data_product);
            $product_id = $this->_id();

            $product_category_sql = "INSERT INTO `" . DB_PREFIX . "product_to_category` (`product_id`, `category_id`) VALUES (:product_id, :category_id);";
            $this->raw($product_category_sql, ["product_id" => $product_id, "category_id" => $category_id]);

            $product_description_sql = "INSERT INTO `" . DB_PREFIX . "product_description` (product_id, language_id, name, description, tag, meta_title, meta_description, meta_keyword) VALUES (:product_id, :language_id, :name, :description, :tag, :meta_title, :meta_description, :meta_keyword);";
            $this->raw($product_description_sql, [
                "product_id" => $product_id,
                "language_id" => "1",
                "name" => $name,
                "description" => $description,
                "tag" => "",
                "meta_title" => $name,
                "meta_description" => "",
                "meta_keyword" => "",
            ]);

            foreach ($stores as $store) {
                $product_to_store_sql = "INSERT INTO `" . DB_PREFIX . "product_to_store` (`product_id`, `store_id`) VALUES (:product_id, :store_id);";
                $this->raw($product_to_store_sql, ["product_id" => $product_id, "store_id" => $store["store_id"]]);
            }
        }
    }
}