<?php

namespace michaelmeelis\DocBlockModelParser\tests;


use michaelmeelis\DocBlockModelParser\Collections\PropertyCollection;
use michaelmeelis\DocBlockModelParser\Model\NormalProperty;

class BaseCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCollection()
    {
        $collection = new PropertyCollection();
        $collection[] = new NormalProperty('test', 'test', 'test');

        $theCollection = $collection->getCollection();

        $this->assertCount(1, $theCollection);
    }

    public function testUnset()
    {
        $collection = new PropertyCollection();
        $collection[] = new NormalProperty('test', 'test', 'test');

        unset($collection[0]);

        $this->assertCount(0, $collection);
    }

    public function testIsset()
    {
        $collection = new PropertyCollection();
        $collection[] = new NormalProperty('test', 'test', 'test');

        $result = isset($collection[0]);

        $this->assertTrue($result);
    }

    public function testGetIterator()
    {
        $collection = new PropertyCollection();
        $collection[] = new NormalProperty('test', 'test', 'test');

        $iterator = $collection->getIterator();

        $this->assertInstanceOf('\ArrayIterator', $iterator);
    }

    public function testOffsetSet()
    {
        $baseCollection = $this->getMockForAbstractClass(
            'michaelmeelis\DocBlockModelParser\Collections\BaseCollection'
        );

        $baseCollection[] = new NormalProperty('test', 'test', 'test');

        $this->assertCount(1, $baseCollection);

    }

    public function testOffsetSetWithKey()
    {
        $baseCollection = $this->getMockForAbstractClass(
            'michaelmeelis\DocBlockModelParser\Collections\BaseCollection'
        );

        $baseCollection['test'] = new NormalProperty('test', 'test', 'test');

        $this->assertCount(1, $baseCollection);

    }

    public function testOffsetGet()
    {
        $baseCollection = $this->getMockForAbstractClass(
            'michaelmeelis\DocBlockModelParser\Collections\BaseCollection'
        );

        $baseCollection[] = new NormalProperty('test', 'test', 'test');
        $property = $baseCollection[0];

        $this->assertInstanceOf('michaelmeelis\DocBlockModelParser\Model\NormalProperty', $property);

    }


}
