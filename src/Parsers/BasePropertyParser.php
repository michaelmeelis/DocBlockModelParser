<?php

namespace BeFriends\Admin\FormCreator\DocBlock\Parsers;


use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlock\Tag\ParamTag;

abstract class BasePropertyParser
{
    protected $idFieldNamePostFix;
    protected $model;
    protected $baseProperties;

    public function __construct($model)
    {
        $this->idFieldNamePostFix = \Config::get('form_creator.idPostFix');
        $this->model = $model;

        $this->baseProperties = $this->getProperties(\Config::get('form_creator.docBlock.baseProperties'));
        $this->basePropertiesKeys = array_keys($this->baseProperties);

        $this->readProperties = $this->getProperties(\Config::get('form_creator.docBlock.readProperties'));
    }

    abstract public function parse();

    protected function getProperties($propertyName)
    {
        $reflection = new \ReflectionClass($this->model);
        $docBlock = new DocBlock($reflection);
        $properties = $docBlock->getTagsByName($propertyName);

        return $this->buildProperties($properties);
    }

    /**
     * @param DocBlock\Tag\ParamTag[]
     * @return array
     */
    private function buildProperties($properties = [])
    {
        $buildProperties = [];
        foreach ($properties as $property) {
            $propertyName = $this->makePropertyNameFromTag($property);
            $buildProperties[$propertyName] = $property->getType();
        }

        return $buildProperties;
    }

    protected function makePropertyNameFromTag(ParamTag $paramTag)
    {
        $name = $paramTag->getVariableName();
        return ltrim($name, '$');
    }

    /**
     * Based on barryvdh ide-helper. Doc block gets the class name and if there is a |
     * then you always need the second one.
     * If there is an array of models (modelname[]) then remove the array notation.
     *
     * @param $className
     * @return string
     */
    public function parseClassName($className)
    {
        if (strpos($className, '|') !== false) {
            $className = explode('|', $className);
            $className = $className[1];
        }

        if (strpos($className, '[]') !== false) {
            $className = rtrim($className, '[]');
        }

        return $className;
    }

    public function getBasePropertyType($basePropertyName)
    {
        if (!$basePropertyName) {
            return '';
        }
        
        return $this->baseProperties[$basePropertyName];
    }

    /**
     * Compare the normal existing fields to the read properties from the ide helper
     * If they match then it's an 1 to N relation.
     * We can do this because a read property is based on a function that links methods to an
     * attribute.
     *
     * @param $propertyName
     * @return bool|string
     */

    public function getBasePropertyName($propertyName)
    {
        foreach ($this->basePropertiesKeys as $basePropertyName) {
            if (strpos($basePropertyName, $propertyName) !== false) {
                return $basePropertyName;
            }
        }
        return false;
    }
}