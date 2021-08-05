<?php
namespace cases;

use PHPUnit\Framework\TestCase;

class IncludeTest extends TestCase
{
	public function testAllPathsExist()
	{
		$paths = explode(PATH_SEPARATOR, ini_get("include_path"));
		
		foreach($paths as $path)
		{
			$this->assertTrue(is_dir($path), "Path does not exist: {$path}");
		}
	}
}