<?php

namespace michaelmeelis\DocBlockModelParser\Interfaces;


interface ModelInterface
{

    /**
     * @return string    return the name of the table that is connected with the model
     */
    public function getTable();
}