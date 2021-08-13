# opencart.phpunit

Test scripts for OpenCart based on PHPUnit


## Environment

* [PHP](https://www.php.net/) 8+
* [PHPUnit](https://phpunit.de/) 9+
* [OpenCart](https://github.com/opencart/opencart) 4+ (master branch)


## Installation

Clone the project:

    git clone https://github.com/anytizer/opencart.phpunit.git


Download the phpunit main phar file in the directory.

    cd opencart.phpunit
    wget https://phar.phpunit.de/phpunit-9.5.8.phar


Update the composer dependencies:

    wget https://getcomposer.org/download/latest-stable/composer.phar
    php composer.phar update


## Configuration

Edit `bootstrap.php` file for pointing to the location of your opencart.


## Run

Under Windows: `run8.0.bat` or Under Linux: `./run8.0.sh`.


## Log

* `logs/testdox.log`
* `logs/inventory.log` reports on products and prices


# Inspirations

* https://github.com/beyondit/opencart-test-suite
* [Selenium : OpenCart User Creation Automation Test With CSS Locators](https://www.youtube.com/watch?v=DEwzzZfMYwM)
* [Unit testing, Jenkins, code sniffing, github etc](https://forum.opencart.com/viewtopic.php?t=124532)
