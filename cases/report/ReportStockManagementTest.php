<?php
namespace cases\general;

use \PHPUnit\Framework\TestCase;
use \library\MySQLPDO as MySQLPDO;

class ReportStockManagementTest extends TestCase
{    
    public function testGenerateInventoryReport()
    {
        $pdo = new MySQLPDO();

        $sql = "
SELECT
    p.product_id,
    cd.name cname,
    p.model,
    p.sku,
    pd.name,
    p.status enabled,
    m.`name` vname,
    mp.product_price vprice,
    p.price,
    p.price - mp.product_price profit,
    p.quantity stock,
    p.minimum,
    p.subtract,
    p.image
FROM oc_product p
INNER JOIN oc_product_description pd ON pd.product_id = p.product_id
INNER JOIN oc_product_to_category pc ON pc.product_id = p.product_id
INNER JOIN oc_category c ON c.category_id = pc.category_id
INNER JOIN oc_category_description cd ON cd.category_id = c.category_id
LEFT OUTER JOIN tw_manufacturer_prices mp ON mp.product_id = p.product_id
LEFT OUTER JOIN oc_manufacturer m ON m.manufacturer_id = mp.manufacturer_id
ORDER BY
    c.parent_id,
    cd.name,
    p.model,
    pd.name
;";
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
        $file = fopen(__ROOT__."/logs/inventory.log", "wb+");
        foreach($data as $inventory)
        {
            /**
             * @todo Read image within ./image dir
             */
            $subtract_tick = $inventory["subtract"]=='1'?'Y':'N';
            $image_tick = is_file($inventory["image"])?"x":".";
            $download_tick = is_file($inventory["image"])?"x":"."; // @todo replace with download tick
            $inventory['price'] = number_format($inventory['price'], 2, ".", ",");
            $inventory['vprice'] = number_format($inventory['vprice'], 2, ".", ",");
            $inventory['profit'] = number_format($inventory['profit'], 2, ".", ",");
            
            /**
             * @see format.txt
             */
            $line = "
{$inventory['name']} #{$inventory['product_id']}: {$inventory['minimum']} of {$inventory['stock']}: ±{$subtract_tick}
{$inventory['cname']} - {$inventory['model']} | {$inventory['sku']}
    {$inventory['price']} - {$inventory['vprice']} = {$inventory['profit']}
    [ {$image_tick} ] Image exists
    [ {$download_tick} ] Linked download exists
";

            fwrite($file, $line);
        }

        fclose($file);
    }
}