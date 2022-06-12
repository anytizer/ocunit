<?php

namespace ocunit\business\cases;

use ocunit\library\Store;
use PHPUnit\Framework\TestCase;
use function ocunit\_env;

class CreateStoreTest extends TestCase
{
    public function testEmptyStores()
    {
        $s = new Store();
        $deleted = $s->truncate();

        $this->assertTrue($deleted);
    }

    public function testCreateStores()
    {
        $stores = _env("stores.ini")["stores"];

        $s = new Store();
        foreach ($stores as $name => $url) {
            $s->store_create($name, $url);
        }

        $this->assertNotEmpty($stores);
    }

    public function testViewStores()
    {
        $s = new Store();
        $stores = $s->stores();

        $this->assertNotEmpty($stores);
    }
}