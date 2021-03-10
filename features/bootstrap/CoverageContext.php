<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Driver\Xdebug3Driver;
use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Report\Html\Facade as ReportHTML;

class CoverageContext implements Context
{
    private static CodeCoverage $coverage;

    /**
     * @BeforeSuite
     */
    public static function setup()
    {
        $filter = new Filter();
        $filter->includeDirectory(__DIR__ . '/../../src');
        $filter->excludeDirectory(__DIR__ . '/../../vendor');

        $driver = new Xdebug3Driver($filter);

        static::$coverage = new CodeCoverage($driver, $filter);
    }

    /**
     * @AfterSuite
     */
    public static function tearDown()
    {
        $writer = new ReportHTML();
        $writer->process(static::$coverage, __DIR__ . '/../../report/coverage-behat');
    }

    /**
     * @BeforeScenario
     */
    public function startCoverage(BeforeScenarioScope $scope)
    {
        static::$coverage->start("{$scope->getFeature()->getTitle()}::{$scope->getScenario()->getTitle()}");
    }

    /**
     * @AfterScenario
     */
    public function stopCoverage()
    {
        static::$coverage->stop();
    }
}
