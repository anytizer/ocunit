<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \library\MySQLPDO as MySQLPDO;

class ReportStockManagementTest extends TestCase
{
    public function testFixShippingRequiresInventorySubtraction()
    {
        # $sql = "UPDATE oc_product SET subtract='1' WHERE shipping='1'";
        # $pdo = new MySQLPDO();
        # $pdo->query($sql);
        
        $this->markTestIncomplete("Shipping must require subtraction in inventory.");
    }
 
    public function testGenerateInventoryReport()
    {
        $pdo = new MySQLPDO();
        $sql = file_get_contents(__ROOT__."/sql/inventory.sql");

        $data = $pdo->query($sql);
        $total = count($data);

        $this->log($data);

        foreach($data as $inventory)
        {
            $this->assertTNotNull($inventory["vprice"], "Missing vendor price for product id #".$inventory["product_id"]);
            $this->assertTrue($inventory["price"] > $inventory["vprice"], "Loss in inventory/vendor pricing.");
        }

        $records = 91;
        $this->assertEquals($records, $total);
    }

    private function log($data)
    {
        $tick = "✓";
        $cross = "x";

        $file = fopen(__ROOT__."/logs/inventory.log", "wb+");
        foreach($data as $inventory)
        {
            /**
             * @todo Read image within ./image dir
             */
            $subtract_tick = $inventory["subtract"]=='1'?'Y':'N';
            $image_tick = is_file($inventory["image"])?$tick:".";
            $download_tick = is_file($inventory["image"])?$tick:"."; // @todo replace with download tick
            $inventory['price'] = number_format($inventory['price'], 2, ".", ",");
            $inventory['vprice'] = number_format($inventory['vprice'], 2, ".", ",");
            $inventory['profit'] = number_format($inventory['profit'], 2, ".", ",");

            /**
             * Product makes sufficient profit based on vendor price by 1.5 times business rule
             * @todo see business rule for profit margnin
             */
            $profit_tick = $inventory["price"] >= $inventory["vprice"] * 1.5 ? $tick: $cross;
            
            /**
             * @see format.txt
             */
            $line = "
{$inventory['name']} #{$inventory['product_id']}: {$inventory['minimum']} of {$inventory['stock']}: ±{$subtract_tick}
{$inventory['cname']} - {$inventory['model']} | {$inventory['sku']}
    {$inventory['price']} - {$inventory['vprice']} = {$inventory['profit']}
    [ {$image_tick} ] Image.   [ {$download_tick} ] Download.   [ {$profit_tick} ] Profit margin.
";

            fwrite($file, $line);
        }

        fclose($file);
    }
}