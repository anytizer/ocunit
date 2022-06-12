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
        $s = new Store();

        $stores = _env("stores.ini")["stores"];

        foreach ($stores as $name => $url) {
            $s->store_create($name, $url);
        }

        $this->assertCount(4, $stores);
    }

    public function testViewStores()
    {
        $s = new Store();
        $stores = $s->stores();

        $this->assertNotEmpty($stores);
    }
}