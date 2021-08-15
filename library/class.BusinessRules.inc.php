<?php
namespace library;

class BusinessRules
{
    /**
     * Factor multiplier that converts vendor price into store price
     * eg. price = vendor price * multiplier
     * eg. vendor price = price / multiplier
     */
    public $multiplier = 2.5;

    /**
     * Database's Tax class ID for Downloadable Product
     * 
     * SELECT * FROM `oc_tax_class` WHERE title LIKE '%download%';
     */
    public $downloadable_product_tax_class_id = 10;

    /**
     * Store's internal/own Manufacturer ID
     * 
     * SELECT manufacturer_id, `name` FROM oc_manufacturer;
     */
    public $internal_sourcing_manufacturer_id = 13;

    /**
     * How many actual products are there in one language (en-gb) in a store?
     * 
     * SELECT COUNT(*) total FROM oc_product WHERE `status`=1;
     */
    public $total_products = 91;

    /**
     * Number of settings/configuratiosn count
     * 
     * SELECT COUNT(*) total FROM oc_setting; -- on a trusted database
     */
    public $settings_count = 373;

    /**
     * Country of business operation
     * 
     * UPDATE oc_country SET `status`=0;
     * UPDATE oc_country SET `status`=1 WHERE iso_code_2='CA';
     */
    public $countries_of_business_operations = ["CA", ];
}
