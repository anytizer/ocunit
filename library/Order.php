<?php

namespace ocunit\library;

use JetBrains\PhpStorm\Pure;

class Order
{
    public function create(): bool
    {
        $created = $this->create_good_order();
        return $created;
    }

    public function create_good_order(): bool
    {
        return true;
    }

    public function create_fake_order(): bool
    {
        return false;
    }

    public function cancel(): bool
    {
        return true;
    }
}