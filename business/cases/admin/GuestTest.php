<?php

namespace ocunit\business\cases\admin;

use Exception;
use ocunit\library\Customer;
use PHPUnit\Framework\TestCase;

class GuestTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testGuestCheckout()
    {
        $guest = new Customer();

        $guest->build_cart();
        $checked_out = $guest->checkout();

        // in the html, hide radio button to choose guest checkout option
        $this->assertFalse($checked_out, "Guest checkout should be disabled.");
    }
}
