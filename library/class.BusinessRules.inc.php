<?php
namespace library;

class BusinessRules
{
    /**
     * Factor multiplyer that converts vendor price into store price
     * eg. price = vendor price * multiplier
     * eg. vendor price = price / multiplier
     */
    public $multiplier = 2.5;

    /**
     * Database's Tax class ID for Downloadable Product
     */
    public $downloadable_product_tax_class_id = 10;

    /**
     * Store's internal/own Manufacturer ID
     */
    public $internal_sourcing_manufacturer_id = 13;

    /**
     * How many actual products are there in one language (en-gb) in a store?
     */
    public $total_products = 91;

    /**
     * Number of settings/configuratiosn count
     * SELECT COUNT(*) total FROM oc_setting;
     */
    public $settings_count = 373;
}