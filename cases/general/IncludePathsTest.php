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

	public function testPhpModulesAvailable()
	{
		$this->assertTrue(function_exists("spl_autoload_register"), "Missing extension: SPL");
		$this->assertTrue(function_exists("gd_info"), "Missing extension: GD");
		$this->assertTrue(function_exists("curl_init"), "Missing extension: cURL");
		$this->assertTrue(function_exists("mb_check_encoding"), "Missing extension: MB String");
	}

	public function testXDebugModuleAvailable()
	{
		$this->assertTrue(function_exists("xdebug_break"), "Missing extension: xDebug.");
		$this->assertTrue(function_exists("xdebug_info"), "xDebug should be upgraded.");

	}

	public function testXDebugShouldNotAutostart()
	{
		/**
		 * xDebug must be present and disabled by default on the server environment
		 */
		$autostart = ini_get("xdebug.remote_autostart")?(int)ini_get("xdebug.remote_autostart"):-1;
		$this->assertEquals(0, $autostart, "xDebug should NOT autostart.");

		$profiler_enable = ini_get("xdebug.profiler_enable")?(int)ini_get("xdebug.profiler_enable"):-1;
		$this->assertEquals(0, $profiler_enable, "xDebug profiler enable value to be 0.");
	}
}