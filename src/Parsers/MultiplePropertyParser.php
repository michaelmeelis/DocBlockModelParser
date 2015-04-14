<?php

namespace BeFriends\Admin\FormCreator\DocBlock\Parsers;


class MultiplePropertyParser extends BasePropertyParser
{
    public function parse()
    {
        $multipleProperties = [];
        foreach ($this->readProperties as $readPropertyKey => $readProperty) {
            if ($this->checkIfMultipleProperty($readProperty)) {
                $multipleProperties[$readPropertyKey] = $this->parseClassName($readProperty);
            }
        }

        return $multipleProperties;
    }

    /**
     *
     * @param $propertyName
     * @return bool
     */
    private function checkIfMultipleProperty($propertyName)
    {
        if (strpos($propertyName, '[]') !== false) {
            return true;
        }

        return false;
    }

}