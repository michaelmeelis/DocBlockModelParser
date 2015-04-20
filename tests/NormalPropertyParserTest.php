<?php
namespace michaelmeelis\DocBlockModelParser\tests;

use michaelmeelis\DocBlockModelParser\Parsers\NormalPropertyParser;
use michaelmeelis\DocBlockModelParser\tests\Mock\ModelOnlyModel;
use michaelmeelis\DocBlockModelParser\tests\Mock\ModelOnlyProperties;

class NormalPropertyParserTest extends \PHPUnit_Framework_TestCase
{

    public function testWithOnlyProperties()
    {
        $model = new ModelOnlyProperties();
        $parser = new NormalPropertyParser($model);
        $result = $parser->parse();

        $this->assertCount(1, $result);
    }

    public function testToCheckIdWorking()
    {
        $model = new ModelOnlyModel();
        $parser = new NormalPropertyParser($model);
        $result = $parser->parse();

        $this->assertCount(0, $result);

    }
}
