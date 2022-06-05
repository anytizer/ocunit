<?php
namespace ocunit\library;

use ocunit\library\MySQLPDO;
use Parsedown;
use function ocunit\_env;

class Information extends MySQLPDO
{
    public function truncate()
    {
        $tables = [
            DB_PREFIX."information",
            DB_PREFIX."information_description",
            DB_PREFIX."information_to_store",
        ];

        foreach($tables as $table) {
            $this->raw("TRUNCATE TABLE `{$table}`;");
        }

        return count($tables);
    }

    public function patch($pattern_files): int
    {
        $stores = _env("stores.ini")["stores"];
        $files = glob($pattern_files);


        $parsedown = new Parsedown();

        #$registry = (new oc())->_registry();
        foreach($files as $file)
        {
            $title = ucwords(str_replace("-", " ", substr(basename($file), 0, -3)));
            $content = file_get_contents($file); // mark down
            $html_content = htmlentities($parsedown->text($content)); // html &lt;...

            $sql_information = "INSERT INTO `".DB_PREFIX."information` (information_id, bottom, sort_order, status) VALUES(NULL, 1, 0, 1)";
            $this->raw($sql_information);
            $information_id = $this->query("SELECT LAST_INSERT_ID() id;")[0]["id"];


            $sql = "INSERT INTO `".DB_PREFIX."information_description` (information_id, language_id, title, description, meta_title, meta_description, meta_keyword) VALUE (:information_id, :language_id, :title, :description, :meta_title, :meta_description, :meta_keyword)";
            $this->raw($sql, [
                "information_id" => $information_id,
                "language_id" => 1,
                "title" => $title,
                "description" => $html_content,
                "meta_title" => $title,
                "meta_description" => "",
                "meta_keyword" => "",
            ]);
            #$information_id = $this->query("SELECT LAST_INSERT_ID() id;")[0]["id"];


            #print_r($stores);
            foreach($stores as $name => $url)
            {
                // $stores = oc_information_to_store
            }



            #$information = new \Opencart\Admin\Model\Catalog\Information($registry);
            #$information->addInformation();

            // INSERT INTO `oc_information` (`information_id`, `bottom`) VALUES (NULL, '1');
            #print("\r\n{$title} - {$file}");
        }

        return count($files);
    }
}