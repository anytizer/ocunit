<?php
namespace cases\catalog;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \library\MySQLPDO;

class ImageTest extends TestCase
{
	public function testCategoryImagesExist()
	{
		$pdo = new MySQLPDO();
		
		$sql = "SELECT category_id, image FROM `".DB_PREFIX."category`;";
		$categories = $pdo->query($sql);

		foreach($categories as $category)
		{
			/**
			 * Cache image file
			 */
			$category_image_cache_file = DIR_OPENCART . 'image/cache' . $category["image"];
			$image_file_exists = file_exists($category_image_cache_file) && is_file($category_image_cache_file);
			$this->assertTrue($image_file_exists, "\033[1;31mMISSING:\033[0m category image (cache) for id: ".$category["category_id"]);

			/**
			 * Main image file
			 */
			$category_image_cache_file = DIR_OPENCART . 'image/' . $category["image"];
			$image_file_exists = file_exists($category_image_cache_file) && is_file($category_image_cache_file);
			$this->assertTrue($image_file_exists, "\033[1;31mMISSING:\033[0m category image (original) for id: ".$category["category_id"]);

			// @todo
			// image is 40 x 40 px for icon.
			// image file is not a php, js, css, html script
			// mime type of the file is an image
			// only png allowed
			// gd can obtain the image info
		}
	}

	public function testProductImagesExist()
	{
		$pdo = new MySQLPDO();
		
		$sql = "SELECT product_id, image FROM `".DB_PREFIX."product`;";
		$products = $pdo->query($sql);

		foreach($products as $product)
		{
			// $this->assertNotEmpty(trim($image["image"]), "Empty image value.");
			$product_image_file = DIR_OPENCART . 'image/' . $product["image"];
			$image_file_exists = file_exists($product_image_file) && is_file($product_image_file);
			$this->assertTrue($image_file_exists, "\033[1;31mMISSING:\033[0m Product image for id: ".$product["product_id"]);

			// @todo
			// image is 40 x 40 px for icon.
			// image file is not a php, js, css, html script
			// mime type of the file is an image
			// only png allowed
			// gd can obtain the image info
		}
	}

	public function testCategoryImagesAreValidImages()
	{
		$this->markTestIncomplete("Only PNG Allowed in category images.");
	}

	public function testProductImagesAreValidImages()
	{
		$this->markTestIncomplete("Only PNG Allowed in product image.");
	}

	public function testImageFilesDoNotContainScripts()
	{
		// for each images:
		// php script is not found in the file.
		$this->markTestIncomplete("Need to scan images for presence of scripts.");
	}
}