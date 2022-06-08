# OCUnit

Merchant oriented test scripts for [OpenCart](https://github.com/opencart/opencart/) based
on [PHPUnit](https://phpunit.de).

__WARNING__: Never execute these tests against your live database or __in server environment__. It is likely to
overwrite the product information, pricing, images, currencies, customers, users, session, emails, passwords and more.
The database will never return to its original state. It even truncates a lot of tables.

**Clone your OpenCart database** for use with OCUnit.
**Run OCUnit at your own risk.** Please learn its aspects, before using it.
Otherwise, you may end up with a corrupted database.

OCUnit is better when you are about to setup a __new store__.

**Disclaimer Story**: This project is NOT about developing the [core OpenCart](https://github.com/opencart/opencart),
but the implementation of OpenCart to run a store. Hence, please do not expect a code coverage test for OpenCart.

OCUnit reads the ACTUAL database configuration values and URLs from within your OpenCart's config.php files to run tests.
There are few [business rules](ini/config.ini) and configurations you should edit before running the test. Rules may differ
as per businesses. Hence, most of the tests are empty. But they should self-guide you technically on how to write the tests.

Some information in this document are drafts only.

# Test Examples

## Test like

* A corresponding image should exist for product or category.
    * [x] Product Image: 800 px x 400 px
    * [x] Category Image: 200 px x 200 px
* [x] A "downloadable" file has to be in a .zip format only.
* [x] Directory listing should be disabled throughout the website - admin or store.
* [x] Store price cannot be less than the manufacturer price even after discounts.
* Updating price makes a history of price change.
    * [x] Keep a log of when prices were changed.
    * [x] Maintain a price change history.
    * [x] Create a price log table.
* Products must have video links associated with them in their description.
* Products must have multiple images.
* [x] Concisely generate inventory statistics.
* Reverse create the database information from your memos and configuration files.
  * [x] Stores and URLs
  * [x] Categories and Products
  * [x] Images
  * [ ] Languages - always default: "1" for en-gb.
  * [x] [Information Pages](ini/information/)

## And NOT test like

* Add product feature should accept an image upload.
* The system should allow to upload a downloadable file.
* Price edit should be working fine.

These are just some samples to illustrate how business rules are tested.

Tests have been now separated to [admin](./admin/cases), [catalog](./catalog/cases) and [business](./business/cases/) to match the nature of OpenCart.

![Sample Output](sample-output.png)


# Test Cases

| Folder    | Case                               | Description
|-----------|------------------------------------|------------------------------------------------
| admin     | [admin](admin/cases/admin)         | various tests in admin features
| catalog   | [api](catalog/cases/api)           | API tests as on [documentation](https://docs.opencart.com/en-gb/system/users/api/)
|           | [business](catalog/cases/business) | business logic tests
|           | [catalog](catalog/cases/catalog)   | frontend general tests
|           | [core](catalog/cases/core)         | opencart core tests
|           | [database](catalog/cases/database) | tests with direct database hits
|           | [general](catalog/cases/general)   | other uncategorized tests appear here
|           | [issues](catalog/cases/issues)     | For issues imported from GitHub and CVE Database
|           | [mail](catalog/cases/mail)         | test email sending features
|           | [report](catalog/cases/report)     | inventory and database statistics from merchant's perspectives
| business  | [cases](business/cases)            | Customized business rules


# Requirements

Dependency                     | Version                       | Description
-------------------------------|-------------------------------|---------------------
[PHP](https://www.php.net/)    | 8.1.1+                        | -
[PHPUnit](https://phpunit.de/) | 9.5.20+                       | -
[OpenCart](https://github.com/opencart/opencart)               | 4.0.0+ | master branch
[relay.php](https://packagist.org/packages/anytizer/relay.php) | -      | composer package of a minimal HTTP client
[guid.php](https://packagist.org/packages/anytizer/guid.php)   | -      | UUID generator
[parsedown](https://github.com/erusev/parsedown)               | -      | .md to .html


# Three steps of Operation


## Step 1: Installation

Clone OpenCart and OCUnit projects. Then install and configure them independently in "/oc/opencart" and "/oc/ocunit".
Also, download the [phpunit](https://phar.phpunit.de/) phar file in the ocunit directory and update the [composer](https://getcomposer.org) dependencies.

    cd htdocs|public_html|www|web
    mkdir oc
    cd oc

    git clone https://github.com/opencart/opencart.git opencart
    git clone https://github.com/anytizer/ocunit.git ocunit

    cd ocunit

    # Download PHPUnit
    wget https://phar.phpunit.de/phpunit-9.5.20.phar
    mv phpunit-9.5.20.phar phpunit.phar

    # Optional
    wget https://getcomposer.org/download/latest-stable/composer.phar
    php composer.phar update


## Step 2: Configurations

**Important** - right after installation, you should consider editing [ini/config.ini](ini/config.ini), [ini/stores.ini](ini/stores.ini), [ini/products.ini](ini/products.ini), ini/information and ini/categories to tell something about your opencart installation.
Merchants may depend on editing these ini files to change the behaviour of OpenCart after first setup.
Though not promised, OCUnit will build the OpenCart database based on these values.


## Step 3: Test Execution

    cd admin
    php ../phpunit.phar cases/admin/

Or,

    cd catalog
    php ../phpunit.phar cases/catalog/

Or,

    cd business
    php ../phpunit.phar cases/


### Logs Produced

* `logs/testdox.txt` - Log of test status - pass or fail of test cases.
  * [admin/logs/testdox.txt](admin/logs/testdox.txt)
  * [catalog/logs/testdox.txt](catalog/logs/testdox.txt)
  * [business/logs/testdox.txt](business/logs/testdox.txt)
* `logs/inventory.log` - concise report about products and prices for the merchant's review.


# Inspirations

* https://github.com/beyondit/opencart-test-suite
* [Selenium : OpenCart User Creation Automation Test With CSS Locators](https://www.youtube.com/watch?v=DEwzzZfMYwM)
* [Unit testing, Jenkins, code sniffing, github etc](https://forum.opencart.com/viewtopic.php?t=124532)
* https://github.com/sarkershantonu/OpencartTesting


# Contribution

If you have a specific idea on how OCUnit (Test scripts for OpenCart based on PHPUnit) should function, fork the project
and open pull request for your new test cases. Or, create a [new issue](https://github.com/anytizer/ocunit/issues/new)
in __@anytizer/ocunit__ project.


# Made with IDEs and tools

* [PHPStorm](https://www.jetbrains.com/phpstorm/?from=anytizer+ocunit)
* [VS Code](https://code.visualstudio.com/download) + [SonarLint](https://www.sonarlint.org/)
* [Notepad++](https://notepad-plus-plus.org/downloads/)
* [SQLYog](https://github.com/webyog/sqlyog-community/wiki/Downloads) Community Edition and [Neor Profile SQL](https://www.profilesql.com/)
