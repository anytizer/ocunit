# opencart.phpunit

Test scripts for OpenCart based on PHPUnit.

The project reads the actual values from your OpenCart configurations and makes [various tests](logs/testdox.txt).
This has sometimes, hardcoded or embeded database IDs which should be changed to fit your store.
Similarly, there are some [business rules](library/class.BusinessRules.inc.php) and [configurations](bootstrap.php) you should edit before running the test.

__WARNING__: Never execute these tests against your live database or in server environment.


## Requirements

* [PHP](https://www.php.net/) 8.0+
* [PHPUnit](https://phpunit.de/) 9.5+
* [OpenCart](https://github.com/opencart/opencart) 4.0+ (master branch)
* [relay.php](https://packagist.org/packages/anytizer/relay.php) -- composer package


## Installation

Clone the project:

    git clone https://github.com/anytizer/opencart.phpunit.git


Download the phpunit main phar file in the directory.

    cd opencart.phpunit
    wget https://phar.phpunit.de/phpunit-9.5.8.phar


Update the composer dependencies:

    wget https://getcomposer.org/download/latest-stable/composer.phar
    php8.0 composer.phar update


## Configuration

Edit `bootstrap.php` file for pointing to the location of your opencart.


## Test Execution

* Under Windows: `run8.0.bat`
* Or, under Linux: `./run8.0.sh`


## Logs

* `logs/testdox.log`
* `logs/inventory.log` reports on products and prices for the merchant.


# Inspirations

* https://github.com/beyondit/opencart-test-suite
* [Selenium : OpenCart User Creation Automation Test With CSS Locators](https://www.youtube.com/watch?v=DEwzzZfMYwM)
* [Unit testing, Jenkins, code sniffing, github etc](https://forum.opencart.com/viewtopic.php?t=124532)
