<?php
namespace cases\business;

use \PHPUnit\Framework\TestCase;

class MaintenanceTest extends TestCase
{
	public function testPreInstallationHook()
	{
	    // absence of config file
		$this->markTestIncomplete("Pre-installation Hook not implemented.");
	}

	public function testPostInstallation()
	{
		// default data are removed
		// default images are removed
        // auto increments of databases IDs are reset
		$this->markTestIncomplete("Post installation Hook not implemented.");
	}
}