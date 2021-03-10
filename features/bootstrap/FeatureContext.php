<?php

use App\Coverage;
use Behat\Behat\Context\Context;

class FeatureContext implements Context
{
    /**
     * @Given I am a coverage test
     */
    public function iAmACoverageTest()
    {
        $method = new Coverage();
        return $method->test();
    }
}
