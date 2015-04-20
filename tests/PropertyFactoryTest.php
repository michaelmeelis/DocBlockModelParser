<?php

namespace michaelmeelis\DocBlockModelParser\tests;


use michaelmeelis\DocBlockModelParser\Factory\PropertyFactory;
use michaelmeelis\DocBlockModelParser\tests\Mock\ModelOnlyModel;
use michaelmeelis\DocBlockModelParser\tests\Mock\ModelOnlyProperties;
use michaelmeelis\DocBlockModelParser\tests\Mock\ModelOnlySingle;

class PropertyFactoryTest extends \PHPUnit_Framework_TestCase
{

    public function testBuildSinglePropertiesOk()
    {
        $singleProperties = new ModelOnlySingle();
        $factory = new PropertyFactory();
        $collection = $factory->buildSingleProperties($singleProperties);

        $this->assertCount(2, $collection);
    }

    public function testBuildNormalPropertiesOk()
    {
        $onlyProperties = new ModelOnlyProperties();
        $factory = new PropertyFactory();
        $collection = $factory->buildNormalProperties($onlyProperties);

        $this->assertCount(1, $collection);
    }

    public function testBuildModelCollectionOk()
    {
        $onlyModel = new ModelOnlyModel();
        $factory = new PropertyFactory();
        $collection = $factory->buildMultipleProperties($onlyModel);

        $this->assertCount(2, $collection);
    }
}
