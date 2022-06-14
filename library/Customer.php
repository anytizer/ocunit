<?php

namespace ocunit\library;

use Exception;
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

    public function login($username = "", $password = ""): bool
    {
        return false;
    }


    /**
     * @throws Exception
     */
    public function build_cart(): Cart
    {
        $registry = (new oc())->_registry();

        $cart = new Cart($registry);
        return $cart;
    }

    public function checkout(): bool
    {
        // cart check out
        $checked_out = false;
        return $checked_out;
    }

    /**
     * @throws Exception
     */
    public function create($info = []): int
    {
        $registry = (new oc())->_registry();
        $customer = new \Opencart\Admin\Model\Customer\Customer($registry);

        $data = [
            "store_id" => "1", // @todo Do not bind customer id to store id
            "customer_group_id" => "1",
            "firstname" => "",
            "lastname" => "",
            "email" => $info["email"],
            "telephone" => "",
            "custom_field" => "",
            "newsletter" => "1",
            "password" => $info["password"],
            "status" => "1",
            "safe" => "1",
            "date_added" => dt(),
        ];

        $customer_id = $customer->addCustomer($data);
        return $customer_id;
    }

    /**
     * @throws Exception
     */
    public function delete_all(): int
    {
        $registry = (new oc())->_registry();

        $customers = $this->query("SELECT customer_id FROM `" . DB_PREFIX . "customer`;", []);
        foreach ($customers as $customer) {
            $c = new \Opencart\Admin\Model\Customer\Customer($registry);
            $c->deleteCustomer($customer["customer_id"]);
        }

        return count($customers);
    }
}