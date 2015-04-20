<?php

namespace michaelmeelis\DocBlockModelParser\tests;


use michaelmeelis\DocBlockModelParser\Collections\PropertyCollection;
use michaelmeelis\DocBlockModelParser\Model\NormalProperty;

class PropertyCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testAddPropertyToCollection()
    {
        $collection = new PropertyCollection();
        $collection[] = new NormalProperty('test', 'test', 'test');

        $this->assertCount(1, $collection);
    }

    public function testAddPropertyWithKeyToCollection()
    {
        $collection = new PropertyCollection();
        $collection['test'] = new NormalProperty('test', 'test', 'test');

        $this->assertInstanceOf('michaelmeelis\DocBlockModelParser\Model\NormalProperty', $collection['test']);
    }

    public function testAddPropertyToCollectionFail()
    {
        $this->setExpectedException('\BadMethodCallException');
        $collection = new PropertyCollection();
        $collection[] = 'test';
    }
}
