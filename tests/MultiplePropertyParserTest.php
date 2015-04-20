<?php

namespace michaelmeelis\DocBlockModelParser\tests;

use michaelmeelis\DocBlockModelParser\Parsers\MultiplePropertyParser;
use michaelmeelis\DocBlockModelParser\tests\Mock\ModelOnlySingle;

class MultiplePropertyParserTest extends \PHPUnit_Framework_TestCase
{
    public function testCheckIfMultiplePropertyPresent()
    {
        $model = new ModelOnlySingle();
        $parser = new MultiplePropertyParser($model);
        $result = $parser->parse();

        $this->assertCount(0, $result);
    }
}
