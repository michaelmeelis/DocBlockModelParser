<?php

namespace michaelmeelis\DocBlockModelParser\Parsers;


class SinglePropertyParser extends BasePropertyParser
{

    public function parse()
    {
        $readProperties = [];
        foreach ($this->readProperties as $readPropertyKey => $readProperty) {
            if ($this->getBasePropertyName($readPropertyKey) !== false) {
                $readProperties[$readPropertyKey] = $this->parseClassName($readProperty);
            }
        }

        return $readProperties;
    }
}