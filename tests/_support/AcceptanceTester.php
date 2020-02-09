<?php
/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause()
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;
    use \Codeception\Lib\Actor\Shared\Friend; 
    use \Codeception\Lib\Actor\Shared\Retry;

   /**
    * Define custom actions here
    */
    //ReusingTestCode Authorization	& session snapshot


    	public function login($name, $password)
        {
            $I = $this;
            // if snapshot exists - skipping login
            if ($I->loadSessionSnapshot('login')) {
                return;
            }
            // logging in
            $I->amOnPage('/my-account');
            $I->submitForm('.login', [
                'username' => $name,
                'password' => $password
            ]);
    		//$I->see($name, '.navbar');
    		$I->see('dashboard');
             // saving snapshot
            $I->saveSessionSnapshot('login');
        }

	//Others function
    public function haveVisible($element)
		{
			$I = $this;
			$value = false;
			$I->executeInSelenium(function(\WebDriver $webDriver)use($element, &$value)
			{
				try
				{
					$element = $webDriver->findElement(WebDriverBy::cssSelector($element));
					$value = $element instanceof RemoteWebElement;
				}
				catch (Exception $e)
				{
					// Swallow exception silently
				}
			});
			return $value;
		}
	
	function seeElement($element)
		{
			try {
				$this->getModule('WebDriver')->_findElements($element);
			} catch (\PHPUnit_Framework_AssertionFailedError $f) {
				return false;
			}
			return true;
		}

	//Close browser tab
	public function closeBrowserTab()
	{
	    $I = $this;
	    $I->executeInSelenium(function (\Facebook\WebDriver\Remote\RemoteWebDriver $webdriver) {
	        $webdriver->close();
	    });
	}

	//Switch to last browser
	public function lastBrowserTab()
	{
	    $I = $this;
	    $I->executeInSelenium(function (\Facebook\WebDriver\Remote\RemoteWebDriver $webdriver) {
	        $handles=$webdriver->getWindowHandles();
	        $last_window = end($handles);
	        $webdriver->switchTo()->window($last_window);
	    });
	}
}
