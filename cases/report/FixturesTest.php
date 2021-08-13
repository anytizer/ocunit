<?php
namespace cases\report;

use \PHPUnit\Framework\TestCase;
use \library\MySQLPDO as MySQLPDO;
use \library\BusinessRules as BusinessRules;

class FixturesTest extends TestCase
{
    public $business_rules;

    public function setUp(): void
    {
        $this->business_rules = new BusinessRules();
    }

    public function testFixShippingRequiresInventorySubtraction()
    {
        $pdo = new MySQLPDO();
        
        $sql = "UPDATE `".DB_PREFIX."product` SET subtract='1' WHERE shipping='1';";
        $pdo->raw($sql);
        
        // tax_class_id == 10 (Downloadable Product)
        $sql = "UPDATE `".DB_PREFIX."product` SET subtract='0' WHERE tax_class_id='{$this->business_rules->downloadable_product_tax_class_id}';";
        $pdo->raw($sql);

        $this->assertTrue(true, "Shipping of tangiable products must require subtraction in inventory.");
    }

    /**
     * @todo Once vendor pricing managed for all products, disable this fixture.
     */
    public function testFixVendorPricingByProductPrice()
    {
        $pdo = new MySQLPDO();
        
        $sql = "DELETE FROM tw_manufacturer_prices;";
        $pdo->raw($sql);

        // @todo Replace 2.5 divider by business rule.
        // 13 = Internal Sourcing
        $sql = "INSERT INTO tw_manufacturer_prices SELECT NULL, {$this->business_rules->internal_sourcing_manufacturer_id}, product_id, price/{$this->business_rules->multiplier} FROM oc_product;";
        $pdo->raw($sql);

        $this->assertTrue(true, "Vendor prices are assigned to Internal Sources.");
    }
}