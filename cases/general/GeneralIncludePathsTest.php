<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;

class GeneralIncludePathsTest extends TestCase
{
	public function testAllIncludedPathsExist()
	{
		$paths = explode(PATH_SEPARATOR, ini_get("include_path"));
		
		foreach($paths as $path)
		{
			$this->assertTrue(is_dir($path), "Path does not exist: {$path}");
		}
	}

	public function testInstallFolderDoesNotExist()
	{
		$install = DIR_OPENCART."install";
		$this->assertFalse(is_dir($install), "Remove install folder!");
	}
}