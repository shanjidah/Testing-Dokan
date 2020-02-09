<?php 


class indiviualproductaddonCest
{
    public function _before(AcceptanceTester $I)
    {
    }
// tests
    public function individualAddon(\Step\Acceptance\MultiSteps $I, 
                                    \Page\Acceptance\AccountPage $vendor,
                                      \Page\Acceptance\ProductPage $product)
    {
      $I->loginAsVendor();
      $product->create('Burger','250','Uncategorized');
      $I->wait(5);
      $I->click('Add Field');
      $I->wait(5);
      $I->CheckOption('//*[@id="wc-pao-addon-content-type-0"]','Checkboxes');
      $I->fillField('#wc-pao-addon-content-name-0','SAusage');
      $I->CheckOption('#wc-pao-addon-content-title-format','Heading');
      $I->checkOption('#wc-pao-addon-description-enable-0');
      $I->fillField('#wc-pao-addon-description-0','SAusage');
      $I->fillField('product_addon_option_label[0][]','SAusage');
      $I->checkOption('.wc-pao-addon-option-price-type','quantity_based');
      $I->fillField('product_addon_option_price[0][]','10');
      $I->checkOption('_product_addons_exclude_global');
      $I->click('Save Product');
       $CustomerView = $I->haveFriend('CustomerView');
        $CustomerView->does(function(AcceptanceTester $I){
            $I->loginAsCustomer();
            $I->amOnPage('/shop/');
            $I->selectOption('//select[@name="orderby"]','Sort by latest');
            $I->wait(5);
            $I->click('//main[@id="main"]/ul/li/a/img');
            $I->click('.wc-pao-addon-field');
            $I->click('//select/option[2]');
            $I->wait(3);
            $I->placeOrder();
            $I->wait(3);
       });
       $CustomerView->leave();
    
  }
}
