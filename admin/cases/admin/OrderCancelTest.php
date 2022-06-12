<?php

namespace cases\admin;

use ocunit\library\Order;
use PHPUnit\Framework\TestCase;

class OrderCancelTest extends TestCase
{
    public function testOrderCancelledProperly()
    {
        $order = new Order();

        $order_id = $order->create_good_order();
        $cancelled = $order->cancel($order_id);

        // order is fully paid, and we have a transaction log in payment gateway
        // order received cancellation request
        // order did not pass x number of days - do not cancel too old orders
        // cancellation request seems to be valid
        // cancel the order successfully
        $this->assertTrue($cancelled);
    }

    public function testDoNotRefundUnpaidOrder()
    {
        $order = new Order();

        $order_id = $order->create_fake_order();
        $cancelled = $order->cancel($order_id); // must fail to cancel this order

        $this->assertFalse($cancelled);
    }
}
