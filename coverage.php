<?php

use App\Coverage;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Driver\Xdebug3Driver;
use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Report\Html\Facade as ReportHTML;

require 'vendor/autoload.php';

// @beforeSuite

$filter = new Filter();
$filter->includeDirectory(__DIR__ . '/src');
$filter->excludeDirectory(__DIR__ . '/vendor');

$driver = new Xdebug3Driver($filter);

$coverage = new CodeCoverage($driver, $filter);

// @beforeScenario

$coverage->start("Foo::Bar");

$method = new Coverage();
$method->test();

// @afterScenario

$coverage->stop();

// @afterSuite

$writer = new ReportHTML();
$writer->process($coverage, __DIR__ . '/report/coverage-behat');
