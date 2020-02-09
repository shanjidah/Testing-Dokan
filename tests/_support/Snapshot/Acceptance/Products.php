<?php
namespace Snapshot\Acceptance;
use Codeception\Util\Locator;
class Products extends \Codeception\Snapshot
{

    /**
     * @var \AcceptanceTester;
     */
    protected $acceptanceTester;

    public function __construct(\AcceptanceTester $I)
    {
        $this->i = $I;
    }

    protected function fetchData()
    {
        // TODO: return a value which will be used for snapshot 

        //Admin order details
        return $this->i->grabMultiple(Locator::firstElement('//table/tbody/tr')); 
    }
}