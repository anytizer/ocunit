<?php
namespace library;

class BusinessRules
{
    /**
     * Factor multiplyer that converts vendor price into store price
     */
    public $multiplier = 2.5;

    /**
     * Database's Tax class ID for Downloable Product
     */
    public $downloadable_product_tax_class_id = 10;

    /**
     * Store's internal Manufacturer ID
     */
    public $internal_sourcing_manufacturer_id = 13;
}