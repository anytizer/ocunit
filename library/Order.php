<?php

namespace ocunit\library;

class Order
{
    public function create(): bool
    {
        return $this->create_good_order();
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