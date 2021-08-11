<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;

class GeneralIncludePathsTest extends TestCase
{
	/**
	 * Standard PHP Tests
	 */
	public function testAllIncludedPathsExist()
	{
		$paths = explode(PATH_SEPARATOR, ini_get("include_path"));
		
		foreach($paths as $path)
		{
			$this->assertTrue(is_dir($path), "Path does not exist: {$path}");
		}
	}

	public function testPhpModulesAvailable()
	{
		// gd_info
		// mb_string
		$this->markTestIncomplete("PHP Modules testing");
	}
}