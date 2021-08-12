<?php
namespace cases\report;

use \PHPUnit\Framework\TestCase;
use \library\MySQLPDO as MySQLPDO;

class ReportStockManagementTest extends TestCase
{
    public function testFixShippingRequiresInventorySubtraction()
    {
        $pdo = new MySQLPDO();
        
        $sql = "UPDATE `".DB_PREFIX."product` SET subtract='1' WHERE shipping='1';";
        $pdo->raw($sql);
        
        // tax_class_id == 10 (Downloadable Prodcut)
        $sql = "UPDATE `".DB_PREFIX."product` SET subtract='0' WHERE tax_class_id='10';";
        $pdo->raw($sql);

        $this->markTestIncomplete("Shipping of tangiable products must require subtraction in inventory.");
    }
 
    public function testInventoryReport()
    {
        $pdo = new MySQLPDO();

        $sql = file_get_contents(__ROOT__."/sql/inventory.sql");
        $data = $pdo->query($sql);
        $total = count($data);

        /**
         * Produce data log as printable report for the merchant.
         */
        $this->_logInventoryData($data);

        foreach($data as $inventory)
        {
            $this->assertNotNull($inventory["vprice"], "Missing vendor price for product id #".$inventory["product_id"]);
            $this->assertTrue($inventory["price"] > $inventory["vprice"], "Loss in inventory/vendor pricing.");
        }

        $records = 91; // how many total products are tehre in one language (en-gb)
        $this->assertEquals($records, $total, "Number of products in the database changed!");
    }

    private function _logInventoryData($data=[])
    {
        $tick = "✓";
        $cross = "x";

        $file = fopen(__ROOT__."/logs/inventory.log", "wb+");
        foreach($data as $inventory)
        {
            /**
             * Overwrite the data
             */
            $inventory['price'] = number_format($inventory['price'], 2, ".", ",");
            $inventory['vprice'] = number_format($inventory['vprice'], 2, ".", ",");
            $inventory['profit'] = number_format($inventory['profit'], 2, ".", ",");
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
            
            /**
             * @see format.txt
             */
            $line = "
{$inventory['name']} #{$inventory['product_id']}: {$inventory['minimum']} of {$inventory['stock']}: ±{$subtract_tick}
{$inventory['cname']} - {$inventory['model']} > {$inventory['sku']}
    {$inventory['price']} - {$inventory['vprice']} = {$inventory['profit']}
    [ {$image_tick} ] Image.   [ {$download_tick} ] Download.   [ {$profit_tick} ] Profits.
";

            fwrite($file, $line);
        }

        fclose($file);
    }
}