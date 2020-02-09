<?php
// namespace Module;


class VendorVacationCest
{
    public function _before(AcceptanceTester $I)
    {
    }


    public function vendorsetVacationSetttings(\Step\Acceptance\MultiSteps $I)
      {
        $I->loginAsVendor();
        $I->click('Settings');
        if ($I->tryToSeeCheckboxIsChecked('#dokan-seller-vacation-activate'))
            {
                $I->checkOption('#dokan-seller-vacation-activate');
            }
        $I->wait(8);
        $I->click('//*[@id="dokan-seller-vacation-date-from"]');
        $I->fillField('//*[@id="dokan-seller-vacation-date-from"]','2020-02-06');
        $I->wait(3);
        $I->click('//*[@id="dokan-seller-vacation-date-to"]');
        $I->fillField('//*[@id="dokan-seller-vacation-date-to"]','2020-11-22');
        $I->wait(4);
        $I->fillField('dokan_seller_vacation_datewise_message','Eid Vacation');
        $I->click('//button[contains(.,"Save")]');
        $I->wait(3);
        $I->click('Update Settings');
      }

     public function customerviewVendorVacation(\Step\Acceptance\MultiSteps $I)
        {
          $I->loginAsCustomer();
          $I->wait(3);
          $I->amonpage('/store-listing/');
          $I->click(['css'=>'.dokan-single-seller:nth-child(1) .dashicons']);
          $I->scrollTo('#primary', 100,600);
          $I->wait(5);
        }
}
