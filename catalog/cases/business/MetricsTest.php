<?php

use ocunit\library\DatabaseExecutor;
use PHPUnit\Framework\TestCase;

class MetricsTest extends TestCase
{
    public function testDimensions()
    {
        $dbx = new DatabaseExecutor();
        $products = $dbx->metrics();

        foreach ($products as $p => $product) {
            /**
             *  [17] => Array
             * (
             * [product_id] => 49
             * [weight] => 0.00000000
             * [weight_class_id] => 1
             * [length] => 0.00000000
             * [width] => 0.00000000
             * [height] => 0.00000000
             * [length_class_id] => 1
             * )
             */

            $this->assertTrue($product["weight"] > 0.00);
            $this->assertTrue($product["length"] > 0.00);
            $this->assertTrue($product["width"] > 0.00);
            $this->assertTrue($product["height"] > 0.00);
        }
    }

    public function testProductHasAtLeastOneCategory()
    {
        // get producets
        // if cagtegory missing, report it.
    }
}