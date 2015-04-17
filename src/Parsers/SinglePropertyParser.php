<?php

namespace michaelmeelis\DocBlockModelParser\Parsers;


class SinglePropertyParser extends BasePropertyParser
{

    public function parse()
    {
        foreach ($this->readProperties as $readPropertyKey => $readProperty) {
            if ($this->getBasePropertyName($readPropertyKey) !== false) {
                $readProperties[$readPropertyKey] = $this->parseClassName($readProperty);
            }
        }

        return $readProperties;
    }

}