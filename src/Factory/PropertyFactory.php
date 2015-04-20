<?php

namespace michaelmeelis\DocBlockModelParser\Factory;


use michaelmeelis\DocBlockModelParser\Collections\PropertyCollection;
use michaelmeelis\DocBlockModelParser\Model\MultipleProperty;
use michaelmeelis\DocBlockModelParser\Model\NormalProperty;
use michaelmeelis\DocBlockModelParser\Model\SingleProperty;
use michaelmeelis\DocBlockModelParser\Parsers\BasePropertyParser;
use michaelmeelis\DocBlockModelParser\Parsers\MultiplePropertyParser;
use michaelmeelis\DocBlockModelParser\Parsers\NormalPropertyParser;
use michaelmeelis\DocBlockModelParser\Parsers\SinglePropertyParser;

class PropertyFactory
{

    /**
     * @param $model
     * @return PropertyCollection
     */
    public function buildSingleProperties($model)
    {
        $parser = new SinglePropertyParser($model);

        return $this->buildModelCollection($parser);
    }

    /**
     * @param $model
     * @return PropertyCollection
     */
    public function buildMultipleProperties($model)
    {
        $parser = new MultiplePropertyParser($model);

        return $this->buildModelCollection($parser);

    }

    /**
     * @param $model
     * @return PropertyCollection
     */
    public function buildNormalProperties($model)
    {
        $collection = new PropertyCollection();
        $parser = new NormalPropertyParser($model);
        $properties = $parser->parse();

        foreach ($properties as $valueType => $property) {
            $collection[] = new NormalProperty($property, $property, $valueType);
        }

        return $collection;
    }

    /**
     * @param BasePropertyParser $parser
     * @return PropertyCollection
     */
    private function buildModelCollection(BasePropertyParser $parser)
    {
        $collection = new PropertyCollection();
        $properties = $parser->parse();

        foreach ($properties as $propertyName => $propertyClassName) {
            $collection[] = $this->buildModelProperty($parser, $propertyName, $propertyClassName);
        }

        return $collection;
    }

    /**
     * @param BasePropertyParser $parser
     * @param string $propertyName
     * @param string $propertyClassName
     * @return SingleProperty|MultipleProperty
     */
    private function buildModelProperty(BasePropertyParser $parser, $propertyName, $propertyClassName)
    {
        $basePropertyName = $parser->getBasePropertyName($propertyName);
        $propertyType = $this->buildPropertyType($parser);
        $property = new $propertyType(
            $propertyName,
            $basePropertyName,
            $parser->getBasePropertyType($basePropertyName)
        );
        $property->setModelClassName($propertyClassName);
        $model = new $propertyClassName();
        $property->table = $model->getTable();

        return $property;
    }

    /**
     * @param BasePropertyParser $parser
     * @return string
     */
    private function buildPropertyType(BasePropertyParser $parser)
    {
        if ($parser instanceof MultiplePropertyParser) {
            return 'michaelmeelis\DocBlockModelParser\Model\MultipleProperty';
        }

        if ($parser instanceof SinglePropertyParser) {
            return 'michaelmeelis\DocBlockModelParser\Model\SingleProperty';
        }

        throw new \BadMethodCallException('Only used for model properties');

    }
}