<?php

namespace BeFriends\Admin\FormCreator\DocBlock\Parsers;


class NormalPropertyParser extends BasePropertyParser
{

    public function parse()
    {
        $normalProperties = [];
        foreach ($this->baseProperties as $valueType => $propertyName) {
            if (!$this->checkIfId($propertyName)) {
                $normalProperties[$valueType] = $propertyName;
            }
        }

        return $normalProperties;
    }

    private function checkIfId($propertyName)
    {
        if ($propertyName === 'id') {
            return true;
        }

        if (strpos($propertyName, \Config::get('form_creator.idPostFix')) === true) {
            return true;
        }

        return false;
    }
}