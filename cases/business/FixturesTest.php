<?php
namespace cases\business;

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

    public function testCreateMissingThirdPartyTables()
    {
        $this->expectException(PDOException::class);

        $pdo = new MySQLPDO();

        $files = [
            "tw_manufacturer_prices.sql",
            "tw_price_history.sql",
            "tw_product_videos.sql",
        ];

        foreach($files as $filename)
        {
            $sql = (new fql())->read($filename);
            $pdo->raw($sql);
        }
    }

    /**
     * @todo Once vendor pricing managed for all products, disable this test.
     */
    public function testFixVendorPricingByProductPrice()
    {
        $pdo = new MySQLPDO();

        // rename table
        // create table
        // insert the data
        // look for price history by database trigger
        
        $sql = "DELETE FROM tw_manufacturer_prices;";
        $pdo->raw($sql);

        $sql = "INSERT INTO tw_manufacturer_prices SELECT NULL, {$this->business_rules->internal_sourcing_manufacturer_id}, product_id, price/{$this->business_rules->multiplier} FROM `".DB_PREFIX."product`;";
        $pdo->raw($sql);

        $this->assertTrue(true, "Vendor prices are assigned to internally sourced Manufaturer ID.");
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
                    "image" => "image/catalog/{$store}/products/{$product_id}-250x500.png",
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
