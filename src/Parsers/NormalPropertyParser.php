<?php

namespace michaelmeelis\DocBlockModelParser\Parsers;


class NormalPropertyParser extends BasePropertyParser
{

    public function parse()
    {
        $normalProperties = [];
        foreach ($this->baseProperties as $propertyName => $valueType) {
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

        $lengthPostFix = strlen(BasePropertyParser::PROPERTY_POSTFIX_ID);
        if (substr($propertyName, -$lengthPostFix) == BasePropertyParser::PROPERTY_POSTFIX_ID){
            return true;
        }

        return false;
    }
}