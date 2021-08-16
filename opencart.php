<?php
$opencart_upload_folder = realpath("../opencart/upload");

/**
 * OpenCart Frontend configuration file
 */
require_once("{$opencart_upload_folder}/config.php");

#require_once("{$opencart_upload_folder}/system/startup.php");
require_once(DIR_SYSTEM . 'helper/general.php');
require_once(DIR_SYSTEM . 'helper/utf8.php');
require_once(DIR_STORAGE . 'vendor/autoload.php');
require_once(DIR_SYSTEM . 'engine/autoloader.php');
require_once(DIR_SYSTEM . 'engine/config.php');
require_once(DIR_SYSTEM . 'framework.php');


/**
 * Loading frontend
 */
#use \Opencart\Admin\Controller\Catalog\Category as category_controller;
#$cc = new category_controller();
#$index = $cc->index();
#echo $index;


/**
 * Loading model only
 */
use \Opencart\Catalog\Model\Catalog\Category as category_model;
$cm = new category_model();
$categories = $cm->getCategories();
print_r($categories);
