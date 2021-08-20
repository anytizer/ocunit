<?php
namespace library;

class BusinessRules
{
    /**
     * Factor multiplier that converts manufacturer price into store price
     * eg. price = manufacturer price * multiplier
     * eg. manufacturer price = price / multiplier
     */
    public float $multiplier = 2.5;

    /**
     * Database's Tax class ID for Downloadable Product
     * 
     * SELECT * FROM `oc_tax_class` WHERE title LIKE '%download%';
     */
    public int $downloadable_product_tax_class_id = 10;

    /**
     * Store's internal/own Manufacturer ID
     * 
     * SELECT manufacturer_id, `name` FROM oc_manufacturer;
     */
    public int $internal_sourcing_manufacturer_id = 13;

    /**
     * How many actual products are there in one language (en-gb) in a store?
     * 
     * SELECT COUNT(*) total FROM oc_product WHERE `status`=1;
     */
    public int $total_products = 91;

    /**
     * Number of settings/configuration count
     * 
     * SELECT COUNT(*) total FROM oc_setting; -- on a trusted database
     */
    public int $settings_count = 373;

    /**
     * Country of business operation
     * 
     * UPDATE oc_country SET `status`=0;
     * UPDATE oc_country SET `status`=1 WHERE iso_code_2='CA';
     */
    public array $countries_of_business_operations = ["CA", ];

    public array $credentials = [];

    public function __construct()
    {
        // guest
        // marketing agent
        // demo admin user
        // other user types...
        // @todo Rename numeral indexes to CONST definitions.
        $this->credentials[0] = new credentials("admin", "admin");
        $this->credentials[1] = new credentials("admin", "garbage");
        $this->credentials[2] = new credentials("customer", "customer");
        $this->credentials[3] = new credentials("customer", "garbage");
    }
}
