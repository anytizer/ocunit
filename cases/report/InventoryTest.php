<?php
namespace cases\report;

use \PHPUnit\Framework\TestCase;
use \library\MySQLPDO as MySQLPDO;
use \library\BusinessRules as BusinessRules;

class InventoryTest extends TestCase
{
    private $business_rules;

    public function setUp(): void
    {
        $this->business_rules = new BusinessRules();
    }
 
    public function testInventoryReport()
    {
        $pdo = new MySQLPDO();

        $sql = file_get_contents(__ROOT__."/sql/inventory.sql");
        $data = $pdo->query($sql);
        $total_products_counted = count($data);

        $taxes = [
            "0" => "None",
        ];
        $taxes_class_sql = "SELECT tax_class_id, title FROM `oc_tax_class`;";
        $taxes_db = $pdo->query($taxes_class_sql);
        foreach($taxes_db as $tax)
        {
            $taxes[$tax["tax_class_id"]] = $tax["title"];
        }

        $lengths = [
            "0" => "None",
        ];
        $length_class_sql = "SELECT length_class_id, unit FROM `oc_length_class_description` WHERE language_id=1;";
        $lengths_db = $pdo->query($length_class_sql);
        foreach($lengths_db as $length)
        {
            $lengths[$length["length_class_id"]] = $length["unit"];
        }

        $weights = [
            "0" => "None",
        ];
        $weight_class_sql = "SELECT weight_class_id, unit FROM `oc_weight_class_description` WHERE language_id=1;";
        $weights_db = $pdo->query($weight_class_sql);
        foreach($weights_db as $weight)
        {
            $weights[$weight["weight_class_id"]] = $weight["unit"];
        }

        /**
         * Produce data log as printable report for the merchant.
         */
        $this->_logInventoryData($data, $taxes, $lengths, $weights);

        foreach($data as $inventory)
        {
            $this->assertNotNull($inventory["vprice"], "Missing vendor price for product {$inventory['name']} #{$inventory['product_id']}");

            $pricing_profitability_managed = $inventory["price"] >= $inventory["vprice"] * $this->business_rules->multiplier;
            $this->assertTrue($pricing_profitability_managed, "Probably loss in pricing based on vendor price.");
        }

        $this->assertEquals($this->business_rules->total_products, $total_products_counted, "Number of products in the database changed! Update \$records.");
    }

    private function _logInventoryData($data=[], $taxes=[], $lengths=[], $weights=[])
    {
        $tick = "✓";
        $cross = "x";

        $file = fopen(__ROOT__."/logs/inventory.log", "wb+");
        foreach($data as $inventory)
        {
            /**
             * Sanitize the data
             */
            $inventory['price'] = number_format($inventory['price'], 2, ".", ",");
            $inventory['vprice'] = number_format($inventory['vprice'], 2, ".", ",");
            $inventory['profit'] = number_format($inventory['profit'], 2, ".", ",");

            $inventory['length'] = number_format($inventory['length'], 2, ".", ",");
            $inventory['width'] = number_format($inventory['width'], 2, ".", ",");
            $inventory['height'] = number_format($inventory['height'], 2, ".", ",");
            $inventory['weight'] = number_format($inventory['weight'], 2, ".", ",");

            $inventory['sku'] = $inventory['sku']!=""?$inventory['sku']:"____";
            $inventory["download"] = ""; // @todo obtain downloadable file

            /**
             * @todo Read image within ./image dir inside upload/.
             */
            $subtract_tick = $inventory["subtract"]=='1'?'Y':'N';
            $image_tick = is_file($inventory["image"])?$tick:".";
            $download_tick = is_file($inventory["download"])?$tick:".";

            /**
             * Product makes sufficient profit based on vendor price by 1.5 times business rule
             * Final product price should include original shipping costs as well.
             * @todo see business rule for profit margnin
             */
            $profit_tick = $inventory["price"] >= $inventory["vprice"] * 1.5 ? $tick: $cross;

            $tax_class_name = $taxes[$inventory['tax_class_id']];
            $length_unit = $lengths[$inventory['length_class_id']];
            $weight_unit = $weights[$inventory['weight_class_id']];
            
            /**
             * @see format.txt
             */
            $product_information = "
{$inventory['name']} #{$inventory['product_id']}: {$inventory['minimum']} of {$inventory['stock']}: ±{$subtract_tick}
{$inventory['cname']} - {$inventory['model']} > {$inventory['sku']}
Tax Class: {$tax_class_name} #{$inventory['tax_class_id']}
{$inventory['length']} x {$inventory['width']} x {$inventory['height']} {$length_unit}: @{$inventory['weight']} {$weight_unit}
    {$inventory['price']} - {$inventory['vprice']} = {$inventory['profit']}
    [ {$image_tick} ] Image.   [ {$download_tick} ] Download.   [ {$profit_tick} ] Profits.
";

            fwrite($file, $product_information);
        }

        fclose($file);
    }
}