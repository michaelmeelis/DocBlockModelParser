<?php

namespace michaelmeelis\DocBlockModelParser\Collections;


use michaelmeelis\DocBlockModelParser\Model\BaseProperty;

class PropertyCollection extends BaseCollection
{
    /**
     * @param BaseProperty[] $collection
     */
    public function __construct($collection = [])
    {
        parent::__construct($collection);
    }

    /**
     * @param mixed $offset
     * @return BaseProperty
     */
    public function offsetGet($offset)
    {
        return isset($this->collection[$offset]) ? $this->collection[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        if (!$value instanceof BaseProperty) {
            throw new \BadMethodCallException('Value must be a property');
        }

        if (empty($offset)) {
            $this->collection[] = $value;
        } else {
            $this->collection[$offset] = $value;
        }


    }

}