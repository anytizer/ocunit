<?php
/**
 * Relative path where your OpenCart is installed.
 * Put without trailing /
 */
$opencart_upload_folder = "../opencart/upload";



/**
 * *********** DO NOT MODIFIY BELOW ***********
 */

require_once("vendor/autoload.php");

/**
 * Test suite specific content
 */
require_once("class.MySQLPDO.inc.php");
require_once("class.api.inc.php");
require_once("class.catalog.inc.php");
require_once("class.admin.inc.php");

/**
 * Frontend config file
 */
require_once("{$opencart_upload_folder}/config.php");

/**
 * Admin config file
 * 
 * Silently load admin configurations too.
 * The admin config for contsants collide with that in frontend.
 */
ob_start();
require_once("{$opencart_upload_folder}/admin/config.php");
ob_end_clean();


/**
 * @todo Utilize search options. Do NOT hard code in test scripts.
 */
class PostQuery
{
    public $page = "index.php";

    public $get = [];
    public $post = [];

    public $lookups = [];

    public function __construct($page="", $get=[], $post=[], $lookups=[])
    {
        $this->page = $page;
        $this->get = $get;
        $this->post = $post;
        $this->lookups = $lookups;
    }
}

$searches_in_html_pages = [
    new PostQuery(
        "index.php",
        [],
        [],
        [
            "Apparels",
            "Perfumes",
            "Toys",
            "<div id=\"toast\"></div>",
        ]
    ),
    new PostQuery(
        // Used electronics, wires and parts
        // index.php?route=product/category&language=en-gb&path=66_63
        // http://localhost/opencart/upload/index.php?route=product/product&language=en-gb&path=66_63&product_id=82
        "index.php",
        [
            "route" => "product/category",
            "language" => "en-gb",
            "path" => "66_63",
        ],
        [],
        [
            "Raspberry Pi",
            ">Micro SD Card 32GB</a></h4>",
            // "<h4><a href="http://localhost/opencart/upload/index.php?route=product/product&amp;language=en-gb&amp;path=66_63&amp;product_id=82">Micro SD Card 32GB</a></h4>",
        ]
    ),
    new PostQuery(
        // http://localhost/opencart/upload/index.php?route=product/product&language=en-gb&path=66_63&product_id=82
        "index.php",
        [
            "route" => "product/product",
            "language" => "en-gb",
            "path" => "66_63",
            "product_id" => 82,
        ],
        [],
        [
            "<h1>Micro SD Card 32GB</h1>",
        ]        
    ),


    new PostQuery(
        "index.php",
        [
            "route" => "api/login",
        ],
        [
			"username" => "test",
			"key" => "9acd35f146d93542c062e73697564373f0eac52ebf84ace1d9f59f2face8c5c4ed67d2939ebe86756e6fe4f1fbeb7bf3189d195883b8556b79339d9f3fbb518c32f9a72ab4226a495c2a6aa0f4508a7f8662d1d8fc7d5cfba81a89294556ba10338771247914482be7ce08e4c196af019802a8b69874a82f50863c7f89f64dcc",
		],
        [
            "api_token"
        ]
    ),
];