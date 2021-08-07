<?php
namespace cases\catalog;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \MySQLPDO;

class CatalogImageTest extends TestCase
{
	public function testCategoryImagesExist()
	{
		$pdo = new MySQLPDO();
		
		$images_sql = "SELECT category_id, image FROM `".DB_PREFIX."category`;";
		$images = $pdo->query($images_sql);

		foreach($images as $image)
		{
			if($image["image"]!="")
			{
				$category_image_file = DIR_OPENCART . 'image/' . $image["image"];
				$image_file_exists = file_exists($category_image_file) && is_file($category_image_file);
				$this->assertTrue($image_file_exists, "Missing category image for id: ".$image["category_id"]);

				// @todo
				// image is 40 x 40 px for icon.
				// image file is not a php script
				// mime type of the file is an image
				// only png allowed
			}
			else
			{
				$this->assertTrue(false, "\033[1;31mBREAKING:\033[0m Category image NOT defined in database for id: ".$image["category_id"]);
			}
		}
	}

	public function testImageFilesDoNotContainScripts()
	{
		// for each images:
		// php script is not found in the file.
		$this->markTestIncomplete("Need to scan images for presence of scripts.");
	}

	public function testCategoryImagesAreValidImages()
	{
		$this->markTestIncomplete("Only PNG Allowed in category images.");
	}

	public function testProductImagesAreValidImages()
	{
		$this->markTestIncomplete("Only PNG Allowed in product image.");
	}
}