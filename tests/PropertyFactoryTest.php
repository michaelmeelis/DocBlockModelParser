<?php

namespace michaelmeelis\DocBlockModelParser\tests;


use michaelmeelis\DocBlockModelParser\Factory\PropertyFactory;
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
}
