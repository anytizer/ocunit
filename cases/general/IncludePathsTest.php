<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;

class IncludePathsTest extends TestCase
{
	/**
	 * Standard PHP Tests
	 */
	public function testAllIncludedPathsExist()
	{
		$paths = explode(PATH_SEPARATOR, ini_get("include_path"));
		
		foreach($paths as $path)
		{
			$this->assertTrue(is_dir($path), "Include path does not exist: {$path}.");
		}
	}
}