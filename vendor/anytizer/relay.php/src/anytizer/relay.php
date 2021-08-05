<?php

namespace anytizer;

/**
 * Sends HTTP Requests via POST or GET combinations
 */
class relay
{
    private $get;
    private $post;

    private $method; // get, post, undefined = get

    /**
     * Custom headers passed programatically
     *
     * @var array
     */
    private $custom_headers = [];

    /**
     * @todo Intake array of custom headers
     */
    public function __construct()
    {
        /**
         * Important to pass by reference.
         * So, changes on those super globals can be accessed instantly.
         */
        $this->get = &$_GET;
        $this->post = &$_POST;

        $this->refill();
    }

    /**
     * Fills any missing SERVER and HEADER values
     */
    private function refill()
    {
        $_SERVER["HTTP_REFERER"] = $this->http_referer();
        $_SERVER["HTTP_USER_AGENT"] = $this->http_useragent();
    }

    /**
     * Generate current HTTP Referrer
     * @return string
     */
    private function http_referer()
    {
        $scheme = !empty($_SERVER["REQUEST_SCHEME"]) ? $_SERVER["REQUEST_SCHEME"] : "http";
        $port = !empty($_SERVER["SERVER_PORT"]) ? ":{$_SERVER["SERVER_PORT"]}" : "";
        $uri = !empty($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : "/";
        $server = !empty($_SERVER["SERVER_NAME"]) ? $_SERVER["SERVER_NAME"] : "localhost";
        $referer = "{$scheme}://{$server}{$port}{$uri}";

        return $referer;
    }

    /**
     * Know the user agent
     * @see http://php.net/manual/en/function.get-browser.php
     */
    private function http_useragent()
    {
        $useragent = isset($_SERVER["HTTP_USER_AGENT"]) ? $_SERVER["HTTP_USER_AGENT"] : "";
        return $useragent;
    }

    /**
     * Force POST method
     */
    public function force_post()
    {
        $this->method = "post";
    }

    /**
     * cURL HTTP Headers only
     *
     * @param array $headers
     */
    public function headers($headers = [])
    {
        $this->custom_headers = [];
        foreach ($headers as $header_name => $header_value) {
            if ($header_name) {
                /**
                 * Force convert to string
                 */
                $this->custom_headers["{$header_name}"] = "{$header_value}";
            }
        }
    }

    /**
     * Always forces GET
     *
     * @param string $url
     * @return bool|string
     */
    public function get($url = "")
    {
        // fetch with get only
        $this->method = "get";

        return $this->fetch($url);
    }

    /**
     * Auto calculates GET or POST method calls
     *
     * @param string $url
     * @return bool|string
     */
    public function fetch($url = "")
    {
        /**
         * @todo Sanitize merge process
         * @todo JSON POST support
         * @todo http_build_query may not be necessary
         */
        $url = $this->parse_merge($url);
        #$get_parameters = http_build_query((array)$this->get); # @todo Merge in URLs - Unused
        $post_parameters = http_build_query((array)$this->post);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        $has_post_data = count($this->post) >= 1;
        $method = $this->http_request_method($has_post_data);
        if ($method == "post") // Plus, get/post request as deisred
        {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_parameters);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        } else if ($method == "get" || true) {
            curl_setopt($ch, CURLOPT_HTTPGET, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        }

        /**
         * @see https://curl.haxx.se/libcurl/c/CURLOPT_CUSTOMREQUEST.html
         */
        #curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 50);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_REFERER, $_SERVER["HTTP_REFERER"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
        curl_setopt($ch, CURLOPT_VERBOSE, false);

        $custom_headers = [];
        foreach ($this->custom_headers as $header_name => $header_value) {
            $custom_headers[] = "{$header_name}: {$header_value}";
        }
        if (count($custom_headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $custom_headers);
        }

        /**
         * @todo Fix the file path in settings
         */
        curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/curl-cookie.jar");
        curl_setopt($ch, CURLOPT_COOKIEFILE, "/tmp/curl-cookie.jar");
        $content_extracted = curl_exec($ch);

        if ($errno = curl_errno($ch)) {
            $error_message = curl_strerror($errno);
            /**
             * @todo Log the error
             * @todo Use exception
             */
            echo "cURL error ({$errno}):\n {$error_message}";
        }
        curl_close($ch);

        return $content_extracted;
    }

    /**
     * @param string $url
     * @return string
     * @todo URL may contain $_GET variables
     *
     */
    private function parse_merge($url = "") // , $data=[])
    {
        $chunks = parse_url($url);
        #print_r($chunks);

        if (empty($chunks["scheme"])) $chunks["scheme"] = "http";
        if (empty($chunks["host"])) $chunks["host"] = "localhost";
        if (empty($chunks["port"])) $chunks["port"] = "";
        if (empty($chunks["user"])) $chunks["user"] = "";
        if (empty($chunks["pass"])) $chunks["pass"] = "";
        if (empty($chunks["path"])) $chunks["path"] = "/";
        if (empty($chunks["query"])) $chunks["query"] = "";
        if (empty($chunks["fragment"])) $chunks["fragment"] = "";

        #print_r($chunks);

        $chunks["pass"] = ($chunks["user"] || $chunks["pass"]) ? ":{$chunks["pass"]}" : "";
        $chunks["port"] = empty($chunks["port"]) ? "" : ":{$chunks["port"]}";

        $queries = [];
        parse_str($chunks["query"], $queries);
        #print_r($queries);
        #print_r(func_get_args());
        #$queries = array_merge((array)$queries, (array)$data);
        $queries = array_merge((array)$queries, $this->get);

        $chunks["query"] = http_build_query($queries);
        $chunks["query"] = $chunks["query"] ? "?{$chunks["query"]}" : "";

        $chunks["fragment"] = $chunks["fragment"] ? "#{$chunks["fragment"]}" : "";

        $url = "{$chunks["scheme"]}://{$chunks["user"]}{$chunks["pass"]}{$chunks["host"]}{$chunks["port"]}{$chunks["path"]}{$chunks["query"]}{$chunks["fragment"]}";

        #echo($url);
        return $url;
    }

    /**
     * Auto calculate how to access the URLs
     *
     * @param bool $has_post_data
     * @return string
     */
    private function http_request_method(bool $has_post_data): string
    {
        /**
         * Was it forced to use specific method?
         */
        $method = $this->method ?? "get"; // get, post
        if ($has_post_data) {
            $method = "post";
        }

        return $method;
    }

    /**
     * Always forces POST
     *
     * @param string $url
     * @return bool|string
     */
    public function post($url = "")
    {
        $this->method = "post";

        return $this->fetch($url);
    }
}
