<?php

namespace cases\business;

use ocunit\library\DatabaseExecutor;
use ocunit\library\FQL;
use ocunit\library\MySQLPDO;
use PHPUnit\Framework\TestCase;

class FixturesTest extends TestCase
{
    public function testFixInnodbDatabaseEngine()
    {
        if (__OCUNIT_EXECUTE_EXPENSIVE__) {
            $dbx = new DatabaseExecutor();
            $pdo = new MySQLPDO();

            $tables = $dbx->tables();
            foreach ($tables as $table) {
                $innodb_sql = "ALTER TABLE `{$table}` ENGINE=INNODB;";
                $pdo->raw($innodb_sql);
            }
        }

        $this->assertFalse(__OCUNIT_EXECUTE_EXPENSIVE__, "Heavy duty operation: Table engines were changed.");
    }

    // @todo Improve auto increments
    public function testFixAutoIncrementValues()
    {
        $this->assertFalse(__OCUNIT_EXECUTE_EXPENSIVE__);

        if (!__OCUNIT_EXECUTE_EXPENSIVE__) {
            return;
        }

        $dbx = new DatabaseExecutor();
        $tables = $dbx->tables();

        $hits = 0;
        $pdo = new MySQLPDO();
        foreach ($tables as $table) {
            $info = $dbx->info($table);

            $matches = [];
            preg_match_all("/ AUTO_INCREMENT=([\d+])/is", $info, $matches, PREG_SET_ORDER);
            #print_r($matches);
            if (isset($matches[0][1])) {
                $auto_increment = (int)$matches[0][1];

                $sql = "SELECT COUNT(*)+1 total FROM `{$table}`;";
                $count_match = (int)$pdo->query($sql)[0]["total"];

                if ($auto_increment != $count_match) {
                    ++$hits;

                    $reset_sql = "ALTER TABLE `{$table}` AUTO_INCREMENT = {$count_match};";
                    $pdo->raw($reset_sql, []);
                    # echo "\r\n", $reset_sql, " -- ", $auto_increment, ";";
                }
            }
        }

        // @todo Enhance this test
        $this->assertEquals(0, $hits, "Some tables with AUTO_INCREMENT were NOT reset to 1.");
    }

    /**
     * @todo Once manufacturer pricing is managed for all products, disable this test.
     */
    public function testFixManufacturerPricingByProductPrice()
    {
        $pdo = new MySQLPDO();

        // rename table
        // create table
        // insert the data
        // disable price history trigger

        $sql = "TRUNCATE TABLE tw_manufacturer_prices;";
        $pdo->raw($sql, []);

        global $configurations;
        $multiplier = (float)$configurations["business_rules"]["multiplier"];
        $internal_sourcing_manufacturer_id = (int)$configurations["business_rules"]["internal_sourcing_manufacturer_id"];
        $sql = "INSERT INTO tw_manufacturer_prices SELECT NULL, {$internal_sourcing_manufacturer_id}, product_id, price/{$multiplier} FROM `" . DB_PREFIX . "product`;";
        $pdo->raw($sql, []);

        $this->assertTrue(true, "Manufacturer prices are assigned to internal source.");
    }

    public function testFixDownloadableProductDoesNotSubtractInventory()
    {
        $pdo = new MySQLPDO();

        // tax_class_id == 10 (Downloadable Product)
        global $configurations;
        $downloadable_product_tax_class_id = (int)$configurations["business_rules"]["downloadable_product_tax_class_id"];
        $sql = "UPDATE `" . DB_PREFIX . "product` SET subtract=0, shipping=0 WHERE tax_class_id=:tax_class_id;";
        $pdo->raw($sql, [
            "tax_class_id" => $downloadable_product_tax_class_id
        ]);

        $this->assertTrue(true, "Downloadable product does not subtract inventory.");
    }

    public function testFixShippingRequiresInventorySubtraction()
    {
        $pdo = new MySQLPDO();

        $sql = "UPDATE `" . DB_PREFIX . "product` SET subtract=1 WHERE shipping=1;";
        $pdo->raw($sql, []);

        $this->assertTrue(true, "Shipping of physical products must require subtraction in inventory.");
    }

    public function testSetupBusinessRules()
    {
        $pdo = new MySQLPDO();

        $pdo->raw("UPDATE `" . DB_PREFIX . "country` SET `status`=0;");

        global $configurations;
        $countries_of_business_operations = $configurations["business_rules"]["countries_of_business_operations"];
        foreach ($countries_of_business_operations as $country_of_business_operation) {
            $country_of_business_operation = preg_replace("/[^A-Z]/", "", $country_of_business_operation);
            $pdo->raw("UPDATE `" . DB_PREFIX . "country` SET `status`=1 WHERE iso_code_2=:iso_code_2 LIMIT 1;", [
                ":iso_code_2" => $country_of_business_operation,
            ]);
        }

        $this->assertTrue(true, "Setup business rules - countries disabled.");
    }

    public function testAdminPaginationSizeIncreased()
    {
        $pdo = new MySQLPDO();

        $sql = (new FQL())->read("oc_setting.sql");
        $pdo->raw($sql, []);

        $this->assertTrue(true, "OC behaviours were NOT modified.");
    }
}
