<?php
namespace cases\business;

use library\DatabaseExecutor;
use \PHPUnit\Framework\TestCase;
use \library\fql as fql;
use \library\MySQLPDO as MySQLPDO;
use \library\BusinessRules as BusinessRules;
use \PDOException;

class FixturesTest extends TestCase
{
    public BusinessRules $business_rules;

    public function setUp(): void
    {
        $this->business_rules = new BusinessRules();
    }

    public function testFixInnodbDatabaseEngine()
    {
        if(__OCUNIT_EXECUTE_EXPENSIVE__)
        {
            $dbx = new DatabaseExecutor();
            $pdo = new MySQLPDO();

            $tables = $dbx->tables();
            foreach($tables as $table)
            {
                $innodb_sql = "ALTER TABLE `{$table}` ENGINE=INNODB;";
                $pdo->raw($innodb_sql);
            }
        }

        $this->assertFalse(__OCUNIT_EXECUTE_EXPENSIVE__, "Heavy duty operation: Table engines were changed.");
    }

    public function testFixAutoIncrementValues()
    {
        $dbx = new DatabaseExecutor();
        $tables = $dbx->tables();

        $hits = 0;
        $pdo = new MySQLPDO();
        foreach($tables as $table)
        {
            $info = $dbx->info($table);

            $matches = [];
            preg_match_all("/ AUTO_INCREMENT\=([\d+]) /is", $info, $matches, PREG_SET_ORDER);
            #print_r($matches);
            if(isset($matches[0][1]))
            {
                $auto_increment = (int)$matches[0][1];

                $sql = "SELECT COUNT(*)+1 total FROM `{$table}`;";
                $count_match = (int)$pdo->query($sql)[0]["total"];

                if($auto_increment!=$count_match)
                {
                    ++$hits;

                    $reset_sql = "ALTER TABLE `{$table}` AUTO_INCREMENT = {$count_match};";
                    $pdo->raw($reset_sql);
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
        
        $sql = "DELETE FROM tw_manufacturer_prices;";
        $pdo->raw($sql);

        $sql = "INSERT INTO tw_manufacturer_prices SELECT NULL, {$this->business_rules->internal_sourcing_manufacturer_id}, product_id, price/{$this->business_rules->multiplier} FROM `".DB_PREFIX."product`;";
        $pdo->raw($sql);

        $this->assertTrue(true, "Manufacturer prices are assigned to internally sourced Manufaturer ID.");
    }

    public function testFixShippingRequiresInventorySubtraction()
    {
        $pdo = new MySQLPDO();
        
        $sql = "UPDATE `".DB_PREFIX."product` SET subtract='1' WHERE shipping='1';";
        $pdo->raw($sql);

        $this->assertTrue(true, "Shipping of tangible products must require subtraction in inventory.");
    }

    public function testFixDownloadableProductDoesNotSubtractInventory()
    {
        $pdo = new MySQLPDO();
        
        // tax_class_id == 10 (Downloadable Product)
        $sql = "UPDATE `".DB_PREFIX."product` SET subtract='0' WHERE tax_class_id='{$this->business_rules->downloadable_product_tax_class_id}';";
        $pdo->raw($sql);

        $this->assertTrue(true, "Downloadable product does not subtract inventory.");
    }

    public function testSetupBusinessRules()
	{
        $pdo = new MySQLPDO();

        $pdo->raw("UPDATE `".DB_PREFIX."country` SET `status`=0;");

        foreach($this->business_rules->countries_of_business_operations as $country_of_business_operation)
		{
            $country_of_business_operation = preg_replace("/[^A-Z]/", "", $country_of_business_operation);
			$pdo->raw("UPDATE `".DB_PREFIX."country` SET `status`=1 WHERE iso_code_2='{$country_of_business_operation}' LIMIT 1;");
		}

		$this->assertTrue(true, "Setup business rules.");
	}

    public function testAdminPaginationSizeIncreased()
    {
        $pdo = new MySQLPDO();

        $sql = (new fql())->read("oc_setting.sql");
        $pdo->raw($sql);

        $this->assertTrue(true, "Admin pagination size increased.");
    }

    /**
     * @todo Empty the image data before running this test.
     */
    public function testFixProductImages()
    {
        $pdo = new MySQLPDO();

        $modified = 0;
        $products_sql = "SELECT product_id, image FROM `".DB_PREFIX."product`;";
        $products = $pdo->query($products_sql);
        foreach($products as $p => $product)
        {
            if(empty($product["image"]))
            {
                $update_sql = "UPDATE `".DB_PREFIX."product` SET image=:image WHERE product_id=:product_id;";

                $store = "store"; // @todo Replace with proper store name
                $product_id = $product["product_id"];
                $pdo->raw($update_sql, [
                    "image" => "image/catalog/{$store}/products/{$product_id}-800x400.png",
                    "product_id" => $product["product_id"],
                ]);

                ++$modified;
            }
        }

        /**
         * By design:
         *    On first run, caches error.
         *    On second run, it is ok.
         */
        $this->assertEquals(0, $modified, "Product images have been auto assigned.");
    }

    /**
     * @todo Empty the image data before running this test.
     */
    public function testFixCategoryImages()
    {
        $pdo = new MySQLPDO();

        $modified = 0;
        $categories_sql = "SELECT category_id, image FROM `".DB_PREFIX."category`;";
        $categories = $pdo->query($categories_sql);
        foreach($categories as $c => $category)
        {
            if(empty($category["image"]))
            {
                $update_sql = "UPDATE `".DB_PREFIX."category` SET image=:image WHERE category_id=:category_id;";

                $store = "store"; // @todo Replace with proper store name
                $category_id = $category["category_id"];
                $pdo->raw($update_sql, [
                    "image" => "image/catalog/{$store}/categories/{$category_id}-200x200.png",
                    "category_id" => $category["category_id"],
                ]);

                ++$modified;
            }
        }

        /**
         * By design:
         *    On first run, caches error.
         *    On second run, it is ok.
         */
        $this->assertEquals(0, $modified, "Category images have been auto assigned.");
    }
}
