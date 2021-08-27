<?php
namespace cases\catalog;

use \PHPUnit\Framework\TestCase;
use \anytizer\relay;
use \library\catalog;


class CatalogTest extends TestCase
{
    public function testIndexPageHasToastDiv()
    {
        $catalog = new catalog();
        $html = $catalog->browse_index();

        $this->assertTrue(str_contains($html, "<div id=\"toast\"></div>"), "Failed checking index page contains toast placeholder.");
    }

    public function testAdminDashboardRequiresLogin()
    {
        // @todo Replace "admin" with a variable.
        $inner_page = HTTP_SERVER."admin/index.php?route=common/dashboard";

        $catalog = new catalog();
        $html = $catalog->open($inner_page);

        /**
         * The page should have been redirected to login form, which contains the following search term:
         */
        $search_string = "Forgotten Password";
        $this->assertTrue(str_contains($html, $search_string), "Dashboard should ask for login.");
    }

    public function testAccountPagesNeedLogin()
    {
        $account_links = [
            "Login" => "account/login",
            "Register" => "account/register",
            "Forgotten Password" => "account/forgotten",
            "My Account" => "account/account",
            "Account Edit" => "account/edit",
            "Password" => "account/password",
            "Address Book" => "account/address",
            "Wish List" => "account/wishlist",
            "Order History" => "account/order",
            "Downloads" => "account/download",
            "Recurring payments" => "account/recurring",
            "Reward Points" => "account/reward",
            "Returns" => "account/returns",
            "Transactions" => "account/transaction",
            "Newsletter" => "account/newsletter",
            "Logout" => "account/logout",
        ];

        foreach($account_links as $link_name => $route)
        {
            $_GET = [
                "route" => $route,
                "language" => "en-gb",
            ];
            $_POST = [];
            $relay = new relay();
            $relay->headers([
                "X-Protection-Token" => "",
            ]);

            $html = $relay->fetch(HTTP_SERVER."index.php");

            /**
             * When page redirected to login form, following message can be seen:
             */
            $search_string = "Forgotten Password";
            $this->assertTrue(str_contains($html, $search_string), "Route {$route} should ask for login.");
        }
    }

    public function testSearchesInPages()
    {
        /**
         * Obtain user defined configurations for store-wide searches
         * @see config.ini
         */
        global $configurations;

        $searches_in_html_pages = [
            $configurations["html_index"],
            $configurations["html_categories"],
            $configurations["html_product_details"],
        ];

        foreach($searches_in_html_pages as $post_query)
        {
            $page = "index.php";

            $_GET = $post_query["get"];
            $_POST = $post_query["post"];
            $lookups = $post_query["lookup"];

            $relay = new relay();
            $relay->headers([
                "X-Protection-Token" => "",
            ]);
            $html = $relay->fetch(HTTP_SERVER.$page);

            foreach($lookups as $lookup)
            {
                $found = str_contains($html, $lookup);
                $this->assertTrue($found, "\033[1;31mFAILED:\033[0m searching [ {$lookup} ] in HTML output.");
            }
        }
    }
}