<?php

namespace cases\admin;

use PHPUnit\Framework\TestCase;

class OrderCancelTest extends TestCase
{
    public function testOrderCancelledProperly()
    {
        // order is fully paid, and we have a transaction log in payment gateway
        // order received cancellation request
        // order did not pass n number of days
        // cancellation request seems valid
        // cancel the order
        $this->markTestIncomplete("Cancelling an order failed.");
    }

    public function testDoNotCancelIncompleteOrder()
    {
        $this->markTestIncomplete("Do NOT allow to cancel an incomplete order.");
    }
}
