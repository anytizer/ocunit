<?php
require_once("../bootstrap.php");
# php ..\phpunit-9.5.8.phar test.php

/**
 * OpenCart Frontend configuration file
 */
ob_start();
global $opencart_upload_folder;
#require_once("{$opencart_upload_folder}/config.php");
#die("Opencart Upload folder: {$opencart_upload_folder}.");
require_once("{$opencart_upload_folder}/system/startup.php");
//require_once(DIR_SYSTEM . 'helper/general.php');
//require_once(DIR_SYSTEM . 'helper/utf8.php');
//require_once(DIR_STORAGE . 'vendor/autoload.php');
//require_once(DIR_SYSTEM . 'engine/autoloader.php');
//require_once(DIR_SYSTEM . 'engine/config.php');
//require_once(DIR_SYSTEM . 'framework.php');
ob_clean();

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
#use \Opencart\Catalog\Model\Catalog\Category as category_model;
#$cm = new category_model();
#$parent_id = 0;
#$categories = $cm->getCategories($parent_id);
#print_r($categories);


#$setting = new Setting();
#$setting->load->model('setting/store');
#print_r($setting);


