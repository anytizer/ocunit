<?php

namespace cases\core;

use \Opencart\System\Library\Log;
use \PHPUnit\Framework\TestCase;

require_once DIR_OPENCART . "system/library/log.php";

class LogTest extends TestCase
{
    public string $filename = "test.log";

    public function setUp(): void
    {
        $full_filename = DIR_LOGS . $this->filename;
        if (is_file($full_filename)) {
            unlink($full_filename);
        }
    }

    public function tearDown(): void
    {
        $full_filename = DIR_LOGS . $this->filename;
        unlink($full_filename);
    }

    public function testLogFileProduced()
    {
        $log = new Log(basename($this->filename));
        $log->write("Message written by unittest.");

        // to force call __destruct()
        unset($log);

        $full_filename = DIR_LOGS . $this->filename;
        $this->assertTrue(is_file($full_filename), "Log file not written to: " . $full_filename);
    }
}
