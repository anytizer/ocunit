<?php
namespace cases\admin;

use \PHPUnit\Framework\TestCase;
use \library\admin as admin;

class DownloadsTest extends TestCase
{
	public function testDownloadableProductHasAFileLinked()
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
             * @todo Downloadable file must be a .zip file
             */
            $masked_file = DIR_STORAGE."download/{$download['filename']}";

            $download_exists = is_file($masked_file);
            $this->assertTrue($download_exists, "Missing download file for download id #{$download['download_id']}: {$download['name']}.");
        }
    }
}
