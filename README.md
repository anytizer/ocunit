# OCUnit

Merchant oriented test scripts for OpenCart based on PHPUnit.

__WARNING__: Never execute these tests against your live database or in server environment. It is likely to override the product information, pricing, session and more.

This project reads the actual configuraion values from within your OpenCart and makes [various tests](logs/testdox.txt).
This has sometimes, hardcoded or embeded Database IDs which should be changed to fit your store.
Similarly, there are some [business rules](library/class.BusinessRules.inc.php) and few [configurations](bootstrap.php) you should edit before running the test.

A list of fixutes is [available here](cases/business/).


## Requirements

* [PHP](https://www.php.net/) 8.0.8+
* [PHPUnit](https://phpunit.de/) 9.5.8+
* [OpenCart](https://github.com/opencart/opencart) 4.0.0+ (master branch)
* [relay.php](https://packagist.org/packages/anytizer/relay.php) -- composer package of a minimal HTTP client


## Installation

Clone the project:

    cd htdocs|public_html|www

    git clone https://github.com/opencart/opencart.git
    git clone https://github.com/anytizer/ocunit.git


Download the phpunit phar file in the directory.

    cd ocunit
    wget https://phar.phpunit.de/phpunit-9.5.8.phar


Update the composer dependencies:

    wget https://getcomposer.org/download/latest-stable/composer.phar
    php8.0 composer.phar update


## Configuration

* Edit `bootstrap.php` file for pointing to the location of your opencart.
* Edit `$searches_in_html_pages` for your products in various pages.
* Edit your [business rules](library/class.BusinessRules.inc.php).


## Test Execution

`php phpunit-9.5.8.phar` runs the entire test cases.

* Under Windows: `run8.0.bat`
* Or, under Linux: `./run8.0.sh`


## Logs Produced

* `logs/testdox.*`
* `logs/inventory.log` reports about products and prices for the merchant.


# Inspirations

* https://github.com/beyondit/opencart-test-suite
* [Selenium : OpenCart User Creation Automation Test With CSS Locators](https://www.youtube.com/watch?v=DEwzzZfMYwM)
* [Unit testing, Jenkins, code sniffing, github etc](https://forum.opencart.com/viewtopic.php?t=124532)


# Contribution

If you have a specific idea on how OCUnit (Test scripts for OpenCart based on PHPUnit) should run, fork the project and submit your test cases.
In general, these test scripts are merchant oriented.
