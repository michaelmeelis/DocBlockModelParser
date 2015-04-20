<?php

namespace michaelmeelis\DocBlockModelParser\tests;


use michaelmeelis\DocBlockModelParser\Model\SingleProperty;

class SinglePropertyTest extends \PHPUnit_Framework_TestCase
{

    public function testSetModelClassName()
    {
        $property = new SingleProperty('test', 'test', 'test');
        $property->setModelClassName('test');

        $this->assertAttributeContains('test', 'modelClassName', $property);
    }

    public function testGetModelClassName()
    {
        $property = new SingleProperty('test', 'test', 'test');
        $property->setModelClassName('test');
        $modelClassName = $property->getModelClassName();

        $this->assertEquals('test', $modelClassName);
    }
}
