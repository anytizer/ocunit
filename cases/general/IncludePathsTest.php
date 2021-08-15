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
		$this->assertTrue(function_exists("spl_autoload_register"), "Missing PHP extension: SPL");
		$this->assertTrue(function_exists("gd_info"), "Missing PHP extension: GD");
		$this->assertTrue(function_exists("curl_init"), "Missing PHP extension: cURL");
		$this->assertTrue(function_exists("mb_check_encoding"), "Missing PHP extension: MB String");

		// more tests required:
		// PDO
		// PostGres if supported for OpenCart
	}

	public function testXDebugModuleAvailable()
	{
		$this->assertTrue(function_exists("xdebug_break"), "Missing PHP extension: xDebug.");

		/**
		 * Looks like only newer version of xDebug has this feature.
		 */
		$this->assertTrue(function_exists("xdebug_info"), "xDebug should be upgraded, if you are using it.");
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