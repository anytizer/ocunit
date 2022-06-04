<?php

namespace ocunit\business\cases;

use ocunit\library\Store;
use PHPUnit\Framework\TestCase;
use function ocunit\_env;

class CreateStoreTest extends TestCase
{
    public function testViewStores()
    {
        $dbx = new Store();
        $stores = $dbx->stores();

        $this->assertNotEmpty($stores);
    }

    public function testEmptyStores()
    {
        $dbx = new Store();
        $deleted = $dbx->stores_delete();

        $this->assertTrue($deleted);
    }

    public function testCreateStores()
    {
        $dbx = new Store();

        $stores = _env("stores.ini")["stores"];

        foreach($stores as $name => $url)
        {
            $dbx->store_create($name, $url);
        }

        $this->assertFalse(false);
    }
}