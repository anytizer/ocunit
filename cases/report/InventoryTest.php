<?php
namespace cases\report;

use \PHPUnit\Framework\TestCase;
use \library\BusinessRules as BusinessRules;
use \library\DatabaseExecuter as DatabaseExecuter;

class InventoryTest extends TestCase
{
    private BusinessRules $business_rules;

    public function setUp(): void
    {
        $this->business_rules = new BusinessRules();
    }
 
    public function testGenerateInventoryReport()
    {
        $dbx = new DatabaseExecuter();
        $inventories = $dbx->inventories();
        $taxes = $dbx->taxes();
        $lengths = $dbx->lengths();
        $weights = $dbx->weights();

        $total_products_counted = count($inventories);

        /**
         * Produce data log as printable report for the merchant.
         */
        $this->_logInventoryForMerchantReports($inventories, $taxes, $lengths, $weights);

        foreach($inventories as $inventory)
        {
            $this->assertNotNull($inventory["mprice"], "Missing manufacturer price for product #{$inventory['product_id']} - {$inventory['name']}");

            $pricing_profitability_managed = $inventory["price"] >= $inventory["mprice"] * $this->business_rules->multiplier;
            $this->assertTrue($pricing_profitability_managed, "Probably loss in final pricing based on manufacturer price.");
        }

        $this->assertEquals($this->business_rules->total_products, $total_products_counted, "Number of products in the database changed! Update \$records.");
    }

    private function _logInventoryForMerchantReports($inventories=[], $taxes=[], $lengths=[], $weights=[])
    {
        $tick = "✓";
        $cross = "x";

        $file = fopen(__OCUNIT_ROOT__."/logs/inventory.log", "wb+");
        foreach($inventories as $inventory)
        {
            /**
             * Sanitize the data
             */
            $inventory["price"] = number_format($inventory["price"], 2, ".", ",");
            $inventory["mprice"] = number_format($inventory["mprice"], 2, ".", ",");
            $inventory["profit"] = number_format($inventory["profit"], 2, ".", ",");

            $inventory["length"] = number_format($inventory["length"], 2, ".", ",");
            $inventory["width"] = number_format($inventory["width"], 2, ".", ",");
            $inventory["height"] = number_format($inventory["height"], 2, ".", ",");
            $inventory["weight"] = number_format($inventory["weight"], 2, ".", ",");

            $inventory["sku"] = $inventory["sku"]!=""?$inventory["sku"]:"____";
            $inventory["download"] = ""; // @todo obtain downloadable file

            /**
             * @todo Read image within ./image dir inside upload/.
             */
            $subtract_tick = $inventory["subtract"]=='1'?'Y':'N';
            $image_tick = is_file($inventory["image"])?$tick:".";
            $download_tick = is_file($inventory["download"])?$tick:".";

            /**
             * Product makes sufficient profit based on manufacturer price by 1.5 times business rule
             * Final product price should include original shipping costs as well.
             * @todo see business rule for profit margin
             */
            $profit_tick = $inventory["price"] >= $inventory["mprice"] * 1.5 ? $tick: $cross;

            $tax_class_name = $taxes[$inventory["tax_class_id"]];
            $length_unit = $lengths[$inventory["length_class_id"]];
            $weight_unit = $weights[$inventory["weight_class_id"]];
            
            /**
             * @see format.txt
             */
            $product_information = "
{$inventory['name']} #{$inventory['product_id']}: {$inventory['minimum']} of {$inventory['stock']}: ±{$subtract_tick}
{$inventory['cname']} - {$inventory['model']} > {$inventory['sku']}
{$tax_class_name} #{$inventory['tax_class_id']}
    {$inventory['length']} x {$inventory['width']} x {$inventory['height']} {$length_unit}: @{$inventory['weight']} {$weight_unit}
    {$inventory['price']} - {$inventory['mprice']} = {$inventory['profit']}
    [ {$image_tick} ] Image.   [ {$download_tick} ] Download.   [ {$profit_tick} ] Profits.

";

            fwrite($file, $product_information);
        }

        fclose($file);
    }
}
