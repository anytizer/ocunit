# OCUnit

Merchant oriented test scripts for OpenCart based on PHPUnit.

__WARNING__: Never execute these tests against your live database or in server environment. It is likely to override the product information, pricing, session and more.
Always choose a database that is not in production. The database may never return to its original state.

This project is NOT about developing the core OpenCart but the implementation of OpenCart to run a store.

OCUnit reads the actual configuration values from within your OpenCart and makes various tests.
This has sometimes, hardcoded or embedded Database IDs which should be changed to fit your store.
There are [business rules](library/class.BusinessRules.inc.php) and few [configurations](bootstrap.php) you should edit before running the test.


## Test Examples

* If you add a category or a product, a corresponding image should exist.
* If you add a download file, it has to be a .zip file only.
* Directory listing is disabled throughout the website,
* Complete [test examples](logs/testdox.txt).


### Other possible tests

* Store price cannot be less than the manufacturer price.
* Products must have videos.
* Price change history is maintained.
* Extension tables are added into the database.


# Test Cases

* [admin](cases/admin) -- various tests in admin features
* [api](cases/api) -- API tests as on [this Documentation](https://docs.opencart.com/en-gb/system/users/api/).
* [business](cases/business) -- business logic tests
* [catalog](cases/catalog) -- frontend general tests
* [core](cases/core) -- opencart core tests
* [database](cases/database) -- tests with direct database hits
* [general](cases/general) -- other uncategorized tests appear here
* [issues](cases/issues) -- For issues imported from GitHub
* [mail](cases/mail) -- test email sending features
* [report](cases/report)-- inventory statistics


# Requirements

* [PHP](https://www.php.net/) 8.0.8+
* [PHPUnit](https://phpunit.de/) 9.5.8+
* [OpenCart](https://github.com/opencart/opencart) 4.0.0+ (master branch)
* [relay.php](https://packagist.org/packages/anytizer/relay.php) -- composer package of a minimal HTTP client


# Installation

Clone the projects and configure/install them independently:

    cd htdocs|public_html|www|web

    git clone https://github.com/opencart/opencart.git
    git clone https://github.com/anytizer/ocunit.git


Download the phpunit phar file in the directory.

    cd ocunit
    wget https://phar.phpunit.de/phpunit-9.5.8.phar


Update the composer dependencies:

    wget https://getcomposer.org/download/latest-stable/composer.phar
    php8.0 composer.phar update


# Configuration

* Edit `bootstrap.php` file for pointing to the location of your opencart.
* Edit `$searches_in_html_pages` for your products in various pages.
* Edit your store-wide [business rules](library/class.BusinessRules.inc.php).


# Test Execution

`php phpunit-9.5.8.phar` runs the entire test cases.

* Under Windows: `.\run8.0.bat`
* Or, under Linux: `./run8.0.sh`

For some advanced uses, to run specific tests, an example would be: `php phpunit-9.5.8.phar cases/general`, which runs faster than running all the test cases.
Other examples are one of:

    phpunit phpunit-9.5.8.phar cases/admin
    phpunit phpunit-9.5.8.phar cases/api
    phpunit phpunit-9.5.8.phar cases/business
    phpunit phpunit-9.5.8.phar cases/catalog
    phpunit phpunit-9.5.8.phar cases/general
    phpunit phpunit-9.5.8.phar cases/report


## Logs Produced

* `logs/testdox.txt`
* `logs/inventory.log` - concise report about products and prices for the merchant.


# Inspirations

* https://github.com/beyondit/opencart-test-suite
* [Selenium : OpenCart User Creation Automation Test With CSS Locators](https://www.youtube.com/watch?v=DEwzzZfMYwM)
* [Unit testing, Jenkins, code sniffing, github etc](https://forum.opencart.com/viewtopic.php?t=124532)
* https://gitlab.com/abricos07/opencart/-/tree/master
* https://github.com/sarkershantonu/OpencartTesting


# Contribution

If you have a specific idea on how OCUnit (Test scripts for OpenCart based on PHPUnit) should function, fork the project and submit your test cases.
Or, mention your issue to __@anytizer__.

In general, these test scripts are merchant oriented, rather than testing the OpenCart itself.


# Made with

* [VS Code](https://code.visualstudio.com/download) + [SonarLint](https://www.sonarlint.org/) | [PHPStorm](https://www.jetbrains.com/phpstorm/?from=anytizer)
