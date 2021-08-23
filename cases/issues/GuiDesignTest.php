<?php
namespace cases\issues;

use PHPUnit\Framework\TestCase;

class GuiDesignTest extends TestCase
{
    public function testDashboardLatestOrders()
    {
        // Minor design issue:
        // Second table has an extra whitespace at least when no data in the table.
    }

    public function testPlaceholderImageFitsSquareArea()
    {
        // 40 x 40 pixels image
        // Use placeholder image when no product/category image found.
        //Placeholder should fit in a square box.
        // when no product/category image found
    }

    public function testShowStoreLogo()
    {
        // admin system > settings > stores
        // Show store logo in the store listing page.
    }

    public function testSmallQuantityInputBox()
    {
        // Frontend: The input field for quantity can become small - in cart page.
    }
}
