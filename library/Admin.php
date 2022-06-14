<?php

namespace ocunit\library;

use anytizer\relay as relay;
use Exception;
use Opencart\Admin\Model\User\User;
use function ocunit\dt;

class Admin extends MySQLPDO
{
    public function login_success_case(): string
    {
        // open login page
        // save session state
        // save cookie state
        // login
        // obtain redirect information
        // go to dashboard, aka redirect information

        // @todo Replace admin with a variable
        $form_html = $this->_browse_login_form();
        $login_token = $this->_parse_login_form($form_html);
        $logged_in_html = $this->_login_attempt_successful($login_token);

        return $logged_in_html;
    }

    private function _browse_login_form(): string
    {
        // HTTP request of the login page
        $login_page = HTTP_CATALOG . "/admin/index.php";
        $_GET = [
            "route" => "common/login",
        ];
        $_POST = [];
        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);
        $html = $relay->fetch($login_page);

        return $html;
    }

    private function _parse_login_form(string $html = ""): string
    {
        $login_token = "";

        $matches = [];
        $link_pattern = "/data-oc-action=\".*?route=(.*?)\&login_token=(.*?)\"/i";
        preg_match_all($link_pattern, $html, $matches, PREG_SET_ORDER);
        //if (assert(count($matches) == 1)) {
        # print_r($matches);
        // Look for:
        #  <button type="button" data-oc-action="http://localhost/oc/store/upload/admin/index.php?route=common/login|login&login_token=f4db649e5bad571d85714acaf3298468" data-oc-form="#form-login" class="btn btn-primary"><i class="fas fa-key"></i> Login</button>
        #echo $html;

        $route = $matches[0][1];
        $login_token = $matches[0][2];
        //assert(strlen($login_token) == strlen("7c650ce5d2f347ec48217ab3efb42f57"));
        //}

        return $login_token;
    }

    /**
     * Login MUST pass successfully.
     *
     * @param string $login_token
     * @return string
     */
    public function _login_attempt_successful(string $login_token = ""): string
    {
        // return login redirect in json
        // generate token in advance using api
        // supply username and password
        // send data to login on this page
        // http://localhost/oc/opencart/upload/admin/index.php?route=common/login|login&login_token=f8ab7db9a7932520a7b044c418828433
        // username=admin
        // password=admin
        // obtain redirect json
        // {
        //  "redirect": "http://localhost/oc/opencart/upload/admin/index.php?route=common/dashboard&user_token=7c650ce5d2f347ec48217ab3efb42f57"
        // }
        global $configurations;
        $credentials = $configurations["credentials"]["admin_valid"];

        $url = HTTP_CATALOG . "admin/index.php";
        $_GET = [
            "route" => "common/login|login",
            "login_token" => $login_token,
        ];
        $_POST = [
            // credentials that should succeed
            "username" => $credentials["username"],
            "password" => $credentials["password"],
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch($url);
        return $html;
    }

    public function login_failure_case(): string
    {
        $form_html = $this->_browse_login_form();
        $login_token = $this->_parse_login_form($form_html);
        $not_logged_in_html = $this->_login_attempt_failure($login_token);

        return $not_logged_in_html;
    }

    /**
     * Do NOT login successfully.
     *
     * @param string $login_token
     * @return string
     */
    private function _login_attempt_failure(string $login_token = ""): string
    {
        global $configurations;
        $credentials = $configurations["credentials"]["admin_invalid"];

        $url = HTTP_CATALOG . "admin/index.php";
        $_GET = [
            "route" => "common/login|login",
            "login_token" => $login_token,
        ];
        $_POST = [
            // supply invalid credentials that should fail
            "username" => $credentials["username"],
            "password" => $credentials["password"],
        ];

        $relay = new relay();
        $relay->headers([
            "X-Protection-Token" => "",
        ]);

        $html = $relay->fetch($url);
        return $html;
    }

    public function delete_all(): int
    {
        $this->query("DELETE FROM `" . DB_PREFIX . "user` WHERE user_group_id=1;");
        $total = $this->query("SELECT COUNT(*) total FROM `" . DB_PREFIX . "user` WHERE user_group_id=1;")[0]["total"];

        return $total;
    }

    /**
     * @throws Exception
     */
    public function create($info = []): int
    {
        $registry = (new oc())->_registry();
        $user = new User($registry);

        $data = [
            "username" => $info["email"],
            "user_group_id" => "1",
            // @todo this password has a problem logging in.
            // @see https://github.com/anytizer/ocunit/issues/4
            "password" => $info["password"],
            "firstname" => "",
            "lastname" => "",
            "email" => $info["email"],
            "image" => "",
            "status" => "1",
            "date_added" => dt(),
        ];

        $user_id = $user->addUser($data);

        return $user_id;
    }
}
