<?php
namespace cases\business;

use \PHPUnit\Framework\TestCase;

class MaintenanceTest extends TestCase
{
	public function testPreInstallationHook()
	{
	    // absence of config file
        // undefined APPLICATION constant
		$this->markTestIncomplete("Pre-installation Hooks are not implemented.");
	}

	public function testPostInstallationHook()
	{
		// default data are removed
		// default images are removed
		$this->markTestIncomplete("Post installation Hooks are not implemented.");
	}
}
