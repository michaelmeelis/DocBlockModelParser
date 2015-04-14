<?php

namespace michaelmeelis\DocBlockModelParser\Model;


class BaseProperty
{
    public $name;
    public $basedOn;
    public $valueType;
    public $table;

    public function __construct($name, $basedOn, $valueType)
    {
        $this->basedOn = $basedOn;
        $this->name = $name;
        $this->valueType = $valueType;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }
}