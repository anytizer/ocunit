<?php

namespace ocunit\library;

class Order
{
    public function create_good_order(): string
    {
        $order_id = "";
        return $order_id;
    }

    public function create_fake_order(): string
    {
        $order_id = "";
        return $order_id;
    }

    public function cancel(): bool
    {
        $cancelled = true;
        return $cancelled;
    }
	
	public function is_paid($order_id)
	{
		// data should appear on payment notification hook log
		$paid = false;
        return $paid;
	}
}