<?php 


class AuctionProductCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    //Admin Set dokan Auction setting for new vendor
    //Admin set to view Auction product in shop page
    public function AuctionSettings(\Step\Acceptance\MultiSteps $I)
    {

    	$I->loginAsAdmin();
    	$I->click('Dokan');
        $I->wait(3);
        $I->click('Settings');
        $I->wait(5);
        $I->click(['link' => 'Selling Options']);

        if ($I->tryToSeeCheckboxIsChecked('#dokan_selling[new_seller_enable_auction]')){
            $I->checkOption('#dokan_selling[new_seller_enable_auction]');
        }
        $I->wait(5);
        $I->click('#dokan_selling #submit');
    	$I->amOnpage('/wp-admin/admin.php?page=wc-settings');
    	$I->click('Auctions');
    	if ($I->tryToSeeCheckboxIsChecked('#simple_auctions_dont_mix_shop')){
            $I->checkOption('#simple_auctions_dont_mix_shop');
        }
         $I->click('Save changes');
         $I->wait(3);
         $I->see('Your settings have been saved.');
 

    }

   //Vendor  create Auction product
    
    public function createAuctionProduct(\Step\Acceptance\MultiSteps $I)
    {
    	$I->loginAsVendor();
    	$I->click('Auction');
    	$I->click('Add New Auction Product');
    	$I->wait('5');
    	$I->fillField('#post-title','New Auction Product');
    	$I->selectOption('product_cat','Uncategorized');
    	$I->checkOption('#_auction_proxy');
        $I->fillField('_auction_start_price','2');
        $I->fillField('_auction_bid_increment','1');
        $I->fillField('#_auction_reserved_price','3');
        $I->fillField('#_regular_price','3');
        $I->click('//input[@id="_auction_dates_from"]');
        $I->wait(2);
        $I->click('Now');
        $I->click('//input[@id="_auction_dates_to"]');
         $I->wait(2);
         $I->click('Now');
         $I->presskey('//dd[3]/div/select','50');
         $I->wait(5);
        $I->click('Add auction Product');
        $I->wait(3);
        $I->see('Success! The product has been updated successfully.');

    }

    // //Two customer bid for auction product

    public function firstCustomerBid(\Step\Acceptance\MultiSteps $I)
    {
    	$I->loginAsCustomer();
    	$I->amOnPage('/shop/');
        $I->selectOption('//select[@name="orderby"]','Sort by latest');
        $I->wait(5);
        $I->click('//main[@id="main"]/ul/li/a/img');
        $I->wait(5);
        $I->click('Bid');
        $I->wait(5);
        $SecondCustomerBid = $I->haveFriend('SecondCustomerBid');
        $SecondCustomerBid->does(function(AcceptanceTester $I){
            $I->loginAsCustomerTwo();
            $I->amOnPage('/shop/');
            $I->selectOption('//select[@name="orderby"]','Sort by latest');
            $I->wait(5);
            $I->click('//main[@id="main"]/ul/li/a/img');
            $I->wait(5);
            $I->click('Bid');
            $I->wait(2);
            $I->click('Bid');
            $I->click('Bid');
            $I->click('Bid');
            
       });
         $SecondCustomerBid->leave();

    }

}
