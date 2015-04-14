<?php

namespace michaelmeelis\DocBlockModelParser\Factory;


use BeFriends\Admin\FormCreator\Collections\PropertyCollection;
use BeFriends\Admin\FormCreator\DocBlock\Model\MultipleProperty;
use BeFriends\Admin\FormCreator\DocBlock\Model\NormalProperty;
use BeFriends\Admin\FormCreator\DocBlock\Model\SingleProperty;
use BeFriends\Admin\FormCreator\DocBlock\Parsers\BasePropertyParser;
use BeFriends\Admin\FormCreator\DocBlock\Parsers\MultiplePropertyParser;
use BeFriends\Admin\FormCreator\DocBlock\Parsers\NormalPropertyParser;
use BeFriends\Admin\FormCreator\DocBlock\Parsers\SinglePropertyParser;

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
        $basePropertyName = $parser->getBasePropertyName($propertyClassName);
        $propertyType = $this->buildPropertyType($parser);
        $property = new $propertyType(
            $propertyName,
            $basePropertyName,
            $parser->getBasePropertyType($basePropertyName)
        );
        $property->setModelClassName($propertyClassName);
        $property->table = with(new $propertyClassName)->getTable();

        return $property;
    }

    /**
     * @param BasePropertyParser $parser
     * @return string
     */
    private function buildPropertyType(BasePropertyParser $parser)
    {
        if ($parser instanceof MultiplePropertyParser) {
            return 'BeFriends\Admin\FormCreator\DocBlock\Model\MultipleProperty';
        }

        if ($parser instanceof SinglePropertyParser) {
            return 'BeFriends\Admin\FormCreator\DocBlock\Model\SingleProperty';
        }

        throw new \BadMethodCallException('Only used for model properties');

    }
}