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

        $data = [
            "store_id" => 1,
            "customer_group_id" => 1,
            "firstname" => "",
            "lastname" => "",
            "email" => "info@example.com",
            "telephone" => "",
            "custom_fieldd" => "",
            "newsletter" => true,
            "password" => password_hash(html_entity_decode("password", ENT_QUOTES, 'UTF-8'), PASSWORD_DEFAULT),
            "status" => 1,
            "safe" => 1,
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