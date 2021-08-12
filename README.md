# opencart.phpunit
Test scripts for OpenCart based on PHPUnit

## Installation

Clone the project:

    git clone https://github.com/anytizer/opencart.phpunit.git


Download the phpunit main phar file in the directory.

    cd opencart.phpunit
    wget https://phar.phpunit.de/phpunit-9.5.8.phar


Update the composer dependencies:

    composer update


## Configuration

Edit `bootstrap.php` file for pointing to the location of your opencart.

## Run

Windows: `run.bat` or Linux: `run8.0.sh`

## log

* `logs/testdox.log`
* `logs/inventory.log` reports on products and prices


# Inspirations

* https://github.com/beyondit/opencart-test-suite
* [Selenium : OpenCart User Creation Automation Test With CSS Locators](https://www.youtube.com/watch?v=DEwzzZfMYwM)
* [Unit testing, Jenkins, code sniffing, github etc](https://forum.opencart.com/viewtopic.php?t=124532)
