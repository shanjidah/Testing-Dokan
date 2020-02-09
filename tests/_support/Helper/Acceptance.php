<?php
namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Acceptance extends \Codeception\Module
{
	public function getJsLog() 
	{
	    $wb = $this->getModule("WebDriver");
	    $logs = $wb->webDriver->manage()->getLog("browser");
	    return $logs;
	}
	public function startBrowser()
	{
	    $this->getModule('WebDriver')->_initializeSession();
	}

	public function changeBrowser($browserName)
	{
	    $this->getModule('WebDriver')->_restart(['browser' => $browser]);
	}

	public function closeBrowser()
	{
	    $this->getModule('WebDriver')->_closeSession();
	}
	public function closeAndInitializeWebDriverSession() 
	{
	    $I = $this->getWebDriver();
	    $I->_closeSession();
	    $I->_initializeSession();
	}
}
