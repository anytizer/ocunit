<?php

namespace cases\general;

use PHPUnit\Framework\TestCase;

class OperatingSystemTest extends TestCase
{
    # mac
    # linux
    # windows
    # arm

    private string $os;
    private string $sapi;
    private string $uname;

    public function setUp(): void
    {
        $this->os = PHP_OS;
        $this->sapi = php_sapi_name();
        $this->uname = php_uname();
    }

    public function testCli()
    {
        $this->assertEquals("cli", $this->sapi);
    }

    public function testOperatingSystem()
    {
        switch ($this->os) {
            case "WINNT":
                $this->assertEquals("Windows NT", substr($this->uname, 0, 10));
                break;
            case "Linux":
            case "Mac":
                $this->assertTrue(true, "Valid operating system.");
                break;
            default:
                $this->fail("Invalid operating system: " . $this->os);
        }
    }
}
