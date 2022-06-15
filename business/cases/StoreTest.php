<?php

namespace ocunit\business\cases;

use ocunit\library\Store;
use PHPUnit\Framework\TestCase;
use function ocunit\_env;

class StoreTest extends TestCase
{
    public function testEmptyStores()
    {
        $s = new Store();
        $total = $s->truncate();

        $this->assertTrue($total);
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

        // when the stores are recreated, count again.
        $this->assertNotEmpty($stores);
    }
}