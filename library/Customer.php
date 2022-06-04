<?php

namespace ocunit\library;

use Opencart\System\Library\Cart\Cart;

class Customer
{
    public function signup($email)
    {

    }

    public function set_password($password)
    {

    }

    public function login($username="", $password=""): bool
    {
        return false;
    }


    public function build_cart(): Cart
    {
        $oc = new oc();

        $registry = $oc->_registry();

        $cart = new Cart($registry);
        return $cart;
    }

    public function checkout(): bool
    {
        // cart check out
        $checked_out = false;
        return $checked_out;
    }
}