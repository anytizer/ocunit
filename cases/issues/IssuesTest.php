<?php
namespace cases\issues;

use \PHPUnit\Framework\TestCase;
use \library\BusinessRules as BusinessRules;
use \library\DatabaseExecutor as DatabaseExecutor;

class IssuesFromGithubTest extends TestCase
{
    public function testCategoryImagePlaceholderInAdmin()
    {
        // Display a placeholder image while listing categories in the admin.
        $this->markTestIncomplete("Image placeholder not applied for categories");
    }

    public function testProductImagePlaceholderInAdmin()
    {
        $this->markTestIncomplete("Image placeholder not applied for products.");
    }

    public function testConsolidatedConfigFile()
    {
        // admin and store-front have exactly same/single config file
    }

    public function testAccountRequiresAdminApprovalBeforeLogin()
    {
        //This message is printed always.
        //Warning: Your account requires approval before you can login.
        //
        //The problem is: user account has status=1 in the database already.
        //Cannot login as customer.
    }

    public function testKeepALogOfAdminAccess()
    {
        // Keep a log of admin login from untrusted sources.
        // catalog/controller/account/login.php
    }

    public function testAddCategoryDescriptionInProductDetailPage()
    {
        // There should be a better option to force visitor see category description (common) while in the product page.
        // May be, a new tab named category along with Description, Previews, and Category Description.
    }

    public function testDoNotReturnProductWithNonExistingProductId()
    {
        //Sales return form accepts a random integer value as Order ID.
        //This feature may impact the future order that matches the order id.
        //A sales return data might be pre-available.
        //
        //Page: admin/index.php?route=sale/returns
        //
        //sales > returns
        //
        //A valid order id must exist for a return.
    }

    public function testShowPreSetupFilePermissions()
    {
        // Linux installation - permissions issues
    }

    public function testDoPostSetupCleanups()
    {
    }

    public function testUserIsRegisteredProperly()
    {
        // Warning: Undefined array key "approval" in D:\htdocs\opencart\upload\catalog\model\account\customer.php on line 15
        //Warning: Undefined array key "approval" in D:\htdocs\opencart\upload\catalog\model\account\customer.php on line 19
        //TypeError: Opencart\Catalog\Model\Account\CustomerGroup::getCustomerGroup(): Argument #1 ($customer_group_id) must be of type int, string given in D:\htdocs\opencart\upload\catalog\model\account\customer_group.php on line 4
        //
        //There is a default customer group available, but yet we see the error.
    }

    public function testAdminPasswordForgotten()
    {
        // The password forgotten feature in admin is no longer accessing the oc_user table.
        // Some faults while calling the API.
    }

    public function testConfusingConstants()
    {
        // 'HTTP_SERVER',
        //'HTTPS_SERVER', // Remove this
        //'HTTP_CATALOG',
        //'HTTPS_CATALOG', // Remove this
        // upload/install/controller/upgrade/upgrade_2.php
        //config.php
        //admin/config.php
        // Remove HTTPS_* for being old styled. Serve in one protocol.
        // Use HTTP_SERVER and HTTP_CATALOG constants only.
    }

    public function testUndefinedCustomFieldKey()
    {
        // Undefined - custom_field key
        // PHP Warning: Undefined array key "custom_field" in catalog\controller\account\edit.php on line 148
    }

    public function testCustomerGroupNotLoaded()
    {
        // Customer Groups not loaded in admin filter
        // Admin > Customers > Filter: Look for customer group list.
        // May be because there are no customers in the database.
    }

    public function testClearingSaas()
    {
        // Clearing SASS in admin - permission issue
        // Linux system permissions. Fine on Windows. The script is however writing a file within "upload" or web directory.
    }

    public function testCannotReadDbSessionData()
    {
        // Error message: On linux system:
        //TypeError: Opencart\System\Library\Session\DB::read(): Return value must be of type array, null returned in
        // system/library/session/db.php on line 21
    }
}
