<?php
// use  Page\Acceptance\AccountPage as Vendor;
use  Page\Acceptance\OrderPage as Customer;
use Codeception\Util\Locator;

class SingleOrderAndUpdateOrderStatusCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    //Customer add to cart single order
    public function singleOrder(\Step\Acceptance\MultiSteps $I)
    {
      $I->loginAsCustomer();
      $I->viewSingleProduct();
      $I->placeOrder();    
    }

    //Vendor Update order status
    public function orderStatusChange(\Step\Acceptance\MultiSteps $I,
                                        \Step\Acceptance\Vendor $vendor)
    {
      $I->loginAsVendor();
      $vendor->updateOrderStatus();
      $I->waitForElementVisible('.dokan-panel-body.general-details', 30);
      $I->see('Completed');
      // $I->seeRecord('wp_dokan_orders', ['order_id' => $order_id]);

    }
}
