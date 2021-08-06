<?php
namespace cases;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay as relay;
use \MySQLPDO;

class CatalogImageTest extends TestCase
{
	public function testCategoryImagesExist()
	{
		$pdo = new MySQLPDO();
		
		$images_sql = "SELECT category_id, image FROM oc_category;";
		$images = $pdo->query($images_sql);

		foreach($images as $image)
		{
			if($image["image"]!="")
			{
				$category_image_file = DIR_OPENCART . 'image/' . $image["image"];
				$this->assertTrue(file_exists($category_image_file), "Missing category image for id: ".$image["category_id"]);
			}
			else
			{
				$this->assertTrue(false, "Category image NOT SET for id: ".$image["category_id"]);
			}
		}
	}

	public function testImageFilesDoNotContainScripts()
	{
		// for each images:
		// php script is not found in the file.
		$this->markTestIncomplete("Need to scan images for presence of scripts.");
	}

	public function testProductImagesAreValidImages()
	{
		$this->markTestIncomplete("Only PNG Allowed in product image.");
	}

	public function testCategoryImagesAreValidImages()
	{
		$this->markTestIncomplete("Only PNG Allowed in category images.");
	}
}