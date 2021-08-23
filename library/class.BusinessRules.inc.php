<?php
namespace library;

class BusinessRules
{
    /**
     * Factor multiplier that converts manufacturer price into store price
     *
     * eg. product price = manufacturer price * multiplier
     * eg. manufacturer price = product price / multiplier
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
        // List of different levels of users with valid and invalid passwords
        // @todo Rename numeral indexes to CONST definitions.
        $this->credentials[0] = new credentials("admin", "admin");
        $this->credentials[1] = new credentials("admin", "garbage");
        // Customer
        $this->credentials[2] = new credentials("customer", "customer");
        $this->credentials[3] = new credentials("customer", "garbage");
        // Guest user
        $this->credentials[4] = new credentials("guest", "guest");
        $this->credentials[5] = new credentials("guest", "garbage");
        // API Login
        $this->credentials[6] = new credentials("test1", "9acd35f146d93542c062e73697564373f0eac52ebf84ace1d9f59f2face8c5c4ed67d2939ebe86756e6fe4f1fbeb7bf3189d195883b8556b79339d9f3fbb518c32f9a72ab4226a495c2a6aa0f4508a7f8662d1d8fc7d5cfba81a89294556ba10338771247914482be7ce08e4c196af019802a8b69874a82f50863c7f89f64dcc");
        $this->credentials[7] = new credentials("api1", "garbage");
        // orders
        // sales
        // returns
        // marketing
        // reports
        // guest
        // marketing agent
        // demo admin user
        // other user types...
    }
}
