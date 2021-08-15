<?php
namespace cases\business;

use \PHPUnit\Framework\TestCase;
use \library\MySQLPDO as MySQLPDO;
use \library\BusinessRules as BusinessRules;
use \PDOException;

class FixturesTest extends TestCase
{
    public $business_rules;

    public function setUp(): void
    {
        $this->business_rules = new BusinessRules();
    }

    public function testCreateMissingThirdPartyTables()
    {
        $this->expectException(PDOException::class);

        $pdo = new MySQLPDO();

        $files = [
            __OCUNIT_ROOT__."/sql/tw_manufacturer_prices.sql",
            __OCUNIT_ROOT__."/sql/tw_price_history.sql",
        ];

        foreach($files as $filename)
        {
            $sql = file_get_contents($filename);
            $pdo->raw($sql);
        }
    }

    /**
     * @todo Once vendor pricing managed for all products, disable this fixture.
     */
    public function testFixVendorPricingByProductPrice()
    {
        $pdo = new MySQLPDO();
        
        $sql = "DELETE FROM tw_manufacturer_prices;";
        $pdo->raw($sql);

        $sql = "INSERT INTO tw_manufacturer_prices SELECT NULL, {$this->business_rules->internal_sourcing_manufacturer_id}, product_id, price/{$this->business_rules->multiplier} FROM `".DB_PREFIX."product`;";
        $pdo->raw($sql);

        $this->assertTrue(true, "Vendor prices are assigned to Internal Sources.");
    }

    public function testFixShippingRequiresInventorySubtraction()
    {
        $pdo = new MySQLPDO();
        
        $sql = "UPDATE `".DB_PREFIX."product` SET subtract='1' WHERE shipping='1';";
        $pdo->raw($sql);

        $this->assertTrue(true, "Shipping of tangiable products must require subtraction in inventory.");
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

        foreach($this->business_rules->countries_of_business_operations as $country_of_business_operation)
		{	
			$pdo->raw("UPDATE `".DB_PREFIX."country` SET `status`=0;");
			$pdo->raw("UPDATE `".DB_PREFIX."country` SET `status`=1 WHERE iso_code_2='{$country_of_business_operation}' LIMIT 1;");
		}

		$this->assertTrue(true, "Setup business rules.");
	}
}
