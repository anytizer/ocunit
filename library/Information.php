<?php

namespace ocunit\library;

use Parsedown;

class Information extends MySQLPDO
{
    public function truncate(): int
    {
        $tables = [
            DB_PREFIX . "information",
            DB_PREFIX . "information_description",
            DB_PREFIX . "information_to_store",
        ];

        foreach ($tables as $table) {
            $this->raw("TRUNCATE TABLE `{$table}`;");
        }

        return count($tables);
    }

    public function patch($pattern_files="/path/ini/information/*.md"): int
    {
        $s = new Store();
        $stores = $s->stores();

        $files = glob($pattern_files);

        $parsedown = new Parsedown();
        foreach ($files as $file) {
            $title = ucwords(str_replace("-", " ", substr(basename($file), 0, -3)));
            $content = file_get_contents($file);
            $html_content = htmlentities($parsedown->text($content)); // html &lt;... ...&gt; | tags

            $sql_information = "INSERT INTO `" . DB_PREFIX . "information` (information_id, bottom, sort_order, status) VALUES(NULL, 1, 0, 1)";
            $this->raw($sql_information);
            $information_id = $this->query("SELECT LAST_INSERT_ID() id;")[0]["id"];

            $sql = "INSERT INTO `" . DB_PREFIX . "information_description` (information_id, language_id, title, description, meta_title, meta_description, meta_keyword) VALUE (:information_id, :language_id, :title, :description, :meta_title, :meta_description, :meta_keyword)";
            $this->raw($sql, [
                "information_id" => $information_id,
                "language_id" => 1,
                "title" => $title,
                "description" => $html_content,
                "meta_title" => $title,
                "meta_description" => "",
                "meta_keyword" => "",
            ]);

            foreach ($stores as $store) {
                $sql = "INSERT INTO `" . DB_PREFIX . "information_to_store` (`information_id`, `store_id`) VALUES (:information_id, :store_id);";
                $this->raw($sql, ["information_id" => $information_id, "store_id" => $store["store_id"]]);
            }
        }

        return count($files);
    }
}