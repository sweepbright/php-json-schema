<?php

namespace Yaoi\Schema\Constraint;


use Yaoi\Schema\Schema;

class Type implements Constraint
{
    const OBJECT = 'object';
    const STRING = 'string';
    const INTEGER = 'integer';
    const NUMBER = 'number';
    const _ARRAY = 'array';
    const BOOLEAN = 'boolean';
    const NULL = 'null';

    public $types;

    public function __construct($type)
    {
        $this->types = is_array($type) ? $type : array($type);
    }

    public function setToSchema(Schema $schema)
    {
        $schema->type = $this;
    }

    public function has($type)
    {
        return in_array($type, $this->types);
    }

    public function isValid($data)
    {
        $ok = false;
        foreach ($this->types as $type) {
            switch ($type) {
                case self::OBJECT:
                    $ok = $data instanceof \stdClass;
                    break;
                case self::_ARRAY:
                    $ok = is_array($data);
                    break;
                case self::STRING:
                    $ok = is_string($data);
                    break;
                case self::INTEGER:
                    $ok = is_int($data);
                    break;
                case self::NUMBER:
                    $ok = is_int($data) || is_float($data);
                    break;
                case self::BOOLEAN:
                    $ok = is_bool($data);
                    break;
                case self::NULL:
                    $ok = null === $data;
                    break;
            }
            if ($ok) {
                return true;
            }
        }
        return false;
    }


}