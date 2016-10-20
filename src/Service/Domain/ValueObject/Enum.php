<?php

namespace Sidebeep\Service\Domain\ValueObject;

use MabeEnum\Enum as Base;

/**
 * Enum Base Value Object
 * @package Sidebeep\Service\Domain\ValueObject
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
abstract class Enum extends Base implements ValueObjectInterface
{

    /**
     * Returns a value object taking PHP native value(s) as argument(s).
     *
     * @return static
     */
    public static function from()
    {
        $enum = func_get_arg(0);
        return static::get($enum);
    }

    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal
     *
     * @param  ValueObjectInterface $object
     * @return bool
     */
    public function compareWith(ValueObjectInterface $object)
    {
        return $this->__toString() === $object->__toString();
    }

    /**
     * Returns a string representation of the value object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) parent::getValue();
    }
}
