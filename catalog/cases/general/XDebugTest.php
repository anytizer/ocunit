<?php

namespace cases\general;

use PHPUnit\Framework\TestCase;

class XDebugTest extends TestCase
{
    public function testXDebugModuleIsAvailable()
    {
        $this->assertTrue(function_exists("xdebug_break"), "Missing PHP extension: xDebug.");

        /**
         * Looks like only newer version of xDebug has this feature.
         */
        $this->assertTrue(function_exists("xdebug_info"), "Consider upgrading your xDebug.");
    }

    public function testXDebugShouldNotAutoStart()
    {
        /**
         * xDebug must be present and disabled by default on the server environment
         */
        $autostart = (int)(ini_get("xdebug.remote_autostart") ?? -1);
        $this->assertEquals(0, $autostart, "xDebug should NOT autostart.");

        $profiler_enable = (int)(ini_get("xdebug.profiler_enable") ?? -1);
        $this->assertEquals(0, $profiler_enable, "xDebug profiler enable value to be 0.");
    }
}
