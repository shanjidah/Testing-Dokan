<?php
namespace Step\Acceptance;
use Codeception\Util\Locator;

class MultiSteps extends \AcceptanceTester
{
	public function loginAsAdmin()
	{
		$I = $this;
		$I->amOnPage('/wp-admin');
         //$I->click('Log in');
         $I->fillField('#user_login', 'admin');
         $I->fillField('#user_pass', 'admin');
         $I->click('Log In');
	}
	public function loginAsVendor()
	{
		$I = $this;
		$I->amOnPage('/');
        $I->click('Log in');
        $I->fillField('username', 'vendor-one');
        $I->fillField('password', '123456');
        $I->click('login');
	}
	public function loginAsVendorTwo()
	{
		$I = $this;
		$I->amOnPage('/');
        $I->click('Log in');
        $I->fillField('username', 'vendor-two');
        $I->fillField('password', '123456');
        $I->click('login');
	}
	public function loginAsCustomer()
	{
		$I = $this;
		$I->amOnPage('/');
        $I->click('Log in');
        $I->fillField('username', 'customer');
        $I->fillField('password', '123456');
        $I->click('login');
	}
	public function addProduct()
	{
		$I = $this;
		$I->click('.products');	
		$I->dontSee('.dokan-alert.dokan-alert-warning');
		$I->click('.dokan-add-product-link a');
		$I->fillField('.dokan-form-control', 'Gold Color Shoe');
		$I->fillField('_regular_price', '500');
		$I->selectOption('#product_cat', 'Uncategorized');
		$I->click('#dokan-create-new-product-btn');
	}
	public function viewSingleProduct()
	{
		$I = $this;
		// $I->amOnPage('store-listing/');
  		// $I->click('//div[@id="dokan-seller-listing-wrap"]/div/ul/li/div/div[2]/a');
  		//  $I->click('//div[@id="dokan-content"]/div[3]/ul/li/a/img');
  		// $I->click('//button[@name="add-to-cart"]');
		$I->click('Shop');
        $I->selectOption('//select[@name="orderby"]','Sort by latest');
        $I->wait(5);
        $I->click('//main[@id="main"]/ul/li/a/img');
	}
	public function viewMultipleProduct()
	{
		$I = $this;
		$I->click('Shop');
        $I->selectOption('//select[@name="orderby"]','Sort by latest');
        $I->wait(5);
        $I->click('//main[@id="main"]/ul/li/a/img');
		// $I->amOnPage('store-listing/');
		// 	$I->click(['css' => '.dokan-single-seller:nth-child(1) .store-content a']);
		// 	$I->click('//li[2]/a/img');
		// 	$I->click('Add to cart');
		// 	$I->waitForElementVisible('.woocommerce-notices-wrapper', 30);
		// $I->amOnPage('store-listing/');
		// 	$I->click(['css' => '.dokan-single-seller:nth-child(1) .store-content a']);
		// 	$I->click('//li[2]/a/img');
			$I->click('Add to cart');
			$I->waitForElementVisible('.woocommerce-notices-wrapper', 30);
	}
	public function viewMultipleVendorMultipleProduct()
	{    
		$I = $this;
		$I->amOnPage('store-listing/');
			$I->click(['css' => '.dokan-single-seller:nth-child(1) .store-content a']);
			$I->click('//li[2]/a/img');
			$I->click('Add to cart');
		$I->amOnPage('store-listing/');
			$I->click(['css' => '.dokan-single-seller:nth-child(2) .store-content a']);
			$I->click('//li[2]/a/img');
			$I->click('Add to cart');
		// $I->amOnPage('store-listing/');
		// 	$I->click(['css' => '.dokan-single-seller:nth-child(2) .store-content a']);
		// 	$I->click('//li[2]/a/img');
		// 	$I->click('Add to cart');
      	// $I->click('Add to cart');
	}
	public function placeOrder()
	{
		$I = $this;
		// $I->click('//button[@name="add-to-cart"]');
		$I->click('Add to cart');
		$I->click('View cart');
		$I->click('Proceed to checkout');
		// $I->fillField('#billing_first_name', randomGenerate()->firstName);
		// $I->fillField('#billing_last_name', randomGenerate()->lastName);
		// $I->fillField('#billing_company', randomGenerate()->company);
		// // $I->selectOption('#select2-billing_country-container', randomGenerate()->country);
		// $I->fillField('#billing_address_1', randomGenerate()->address);
		// $I->fillField('#billing_city', randomGenerate()->city);
		// $I->fillField('#billing_phone', randomGenerate()->phoneNumber);
		// $I->fillField('#billing_email', randomGenerate()->email);
		$I->wait(5);
		$I->click('//div[@id="payment"]/div/button');
		$I->waitForText('Thank you. Your order has been received.', 30, '.woocommerce-order');

		// $I->click('//div[@id="payment"]/div/button', 'Place order');
		// $I->wait(10);

	}
	public function updateOrderStatus()
		{
	    	$I =$this;
	    	$I->click('Orders');
	        $I->click(Locator::elementAt('//table/tbody/tr/td[2]', 1));
	        $I->wait(5);
	        $I->see('edit');
	        $I->click('.dokan-edit-status');
	          // $I->orderStatusTest();
	        $I->selectOption('#order_status','Completed');
	        $I->click('Update');
	        $I->wait('5');
	        $I->click('Orders');
	        $I->click(Locator::elementAt('//table/tbody/tr/td[2]', 2));
	        $I->wait(5);
	        $I->see('edit');
	        $I->click('.dokan-edit-status');
	          // $I->orderStatusTest();
	        $I->selectOption('#order_status','Completed');
	        $I->click('Update');
	        $I->wait('5');
	        $I->click('Orders');
	        $I->click(Locator::elementAt('//table/tbody/tr/td[2]', 3));
	        $I->wait(5);
	        $I->see('edit');
	        $I->click('.dokan-edit-status');
	          // $I->orderStatusTest();
	        $I->selectOption('#order_status','Completed');
	        $I->click('Update');
	        $I->wait('5');
		}
		public function checkError()
	    {
	        $I = $this;
	        $I->dontSee('Warning');
	        $I->dontSee('Fatal error');
	        $I->dontSee('Notice:');
	    }
}