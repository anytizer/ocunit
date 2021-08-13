<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;
use \library\admin as admin;

class DownloadsTest extends TestCase
{
	public function testDownloadablePrdouctsHasActiveDownloadableFile()
    {
        // for each downloadable product
        // download product is masked
        // download product is actively linked
        // customer who purchased a download can download
        // download links are protected with login

        $admin = new admin();
        $downloads = $admin->downloads();
        
        foreach($downloads as $download)
        {
            /**
             * @todo Figure out where is the downloadable file
             */
            $masked_file = DIR_STORAGE."download/{$download['filename']}";

            $download_exists = is_file($masked_file);
            $this->assertTrue($download_exists, "Missing download #{$download['download_id']}: {$download['name']}.");
        }
    }

    public function testDownloadCounter()
    {
        // download counter added right after a product is downloaded
        $this->markTestIncomplete("Downloadables statistics is not implemented.");
    }
}
