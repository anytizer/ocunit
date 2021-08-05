# relay.php

Simple cURL based HTTP Client that __relays__ GET/POST data.


## Usage

    <?php
    use anytizer\relay;

    // Fill up your data here, yes: super globals.
    $_GET = [];
    $_POST = [];

    $relay = new relay();
    $relay->headers([
        "X-Protection-Token" => "",
    ]);
    $result = $relay->fetch($url);


## Installation

Use one of the following:

    composer global require anytizer/relay.php=dev-master
    composer require anytizer/relay.php=dev-master


## Third party

 * Includes access to [ipify](https://www.ipify.org/) ([project](https://github.com/rdegges/ipify-api/)) and [hookbin](https://hookbin.com/) for test purpose.
