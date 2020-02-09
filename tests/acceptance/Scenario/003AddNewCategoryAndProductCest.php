<?php
// namespace Vendor;


class AddNewProductCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    //Add new category
    public function addNewCategory(\Step\Acceptance\MultiSteps $I, 
                                    \Page\Acceptance\AdminPage $adminCreate)
    {
      $I->loginAsAdmin();
      $I->amOnPage($adminCreate::$URL);
      $adminCreate->category('Electronics2');
    }
    // Multiple Vendor Add New Product
    public function addNewProduct(\Step\Acceptance\MultiSteps $I,
                                  \Page\Acceptance\AccountPage $vendor,
                                  \Page\Acceptance\ProductPage $product)
    {
      // Vendor Two Add new product
        $I->loginAsVendorTwo();
        $product->create('Watch','450','Electronics');
        $I->waitForText('Edit Product', 30);
        $I->click('Log out');
      // Vendor One Add New product
        $I->loginAsVendor();
        $product->create('Green Watch','250','Electronics');
        $I->waitForText('Edit Product', 30);

    }
}
