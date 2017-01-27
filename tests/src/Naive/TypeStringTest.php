<?php

namespace Yaoi\Schema\Tests\Naive;


use Yaoi\Schema\Exception\TypeException;
use Yaoi\Schema\InvalidValue;
use Yaoi\Schema\SchemaLoader;
use Yaoi\Schema\OldSchema;

class TypeStringTest extends \PHPUnit_Framework_TestCase
{
    public function testValid()
    {
        $schema = SchemaLoader::create()->readSchema(
            array(
                'type' => 'string',
            )
        );
        $this->assertSame('123', $schema->import('123'));
    }

    public function testInvalidInteger()
    {
        $schema = SchemaLoader::create()->readSchema(
            array(
                'type' => 'integer',
            )
        );
        $this->setExpectedException(get_class(new TypeException()), 'Integer required');
        $this->assertSame(123, $schema->import('123'));
    }
}