<?php
namespace cases\business;

use \PHPUnit\Framework\TestCase;
use \library\BusinessRules as BusinessRules;
use \library\MySQLPDO as MySQLPDO;

class OperationsTest extends TestCase
{
	public function testSetupBusinessRules()
	{
		$pdo = new MySQLPDO();

		$business_rules = new BusinessRules();
		foreach($business_rules->countries_of_business_operations as $country_of_business_operation)
		{	
			$pdo->raw("UPDATE `".DB_PREFIX."country` SET `status`=0;");
			$pdo->raw("UPDATE `".DB_PREFIX."country` SET `status`=1 WHERE iso_code_2='{$country_of_business_operation}' LIMIT 1;");
		}

		$this->assertTrue(true, "Setup business rules.");
	}
}