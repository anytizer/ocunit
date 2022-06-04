<?php

namespace ocunit\library;

use Opencart\System\Library\Cart\Cart;
use function ocunit\dt;

class Customer extends MySQLPDO
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

    public function create($info=[]): int
    {
        $registry = (new oc())->_registry();
        $customer = new \Opencart\Admin\Model\Customer\Customer($registry);

        $password_hash = password_hash($info["password"], PASSWORD_DEFAULT);
        $rehash = password_needs_rehash($password_hash, PASSWORD_DEFAULT);
        if ($rehash) {
            $password_hash = password_hash($info["password"], PASSWORD_DEFAULT);
        }

        $data = [
            "store_id" => "1",
            "customer_group_id" => "1",
            "firstname" => "",
            "lastname" => "",
            "email" => $info["email"],
            "telephone" => "",
            "custom_field" => "",
            "newsletter" => "1",
            "password" => $password_hash,
            "status" => "1",
            "safe" => "1",
            "date_added" => dt(),
        ];

        $customer_id = $customer->addCustomer($data);
        return $customer_id;
    }

    public function delete_all()
    {
        $registry = (new oc())->_registry();

        $customers = $this->query("SELECT customer_id FROM `".DB_PREFIX."customer`;", []);
        foreach($customers as $customer) {
            $c = new \Opencart\Admin\Model\Customer\Customer($registry);
            $c->deleteCustomer($customer["customer_id"]);
        }
    }
}