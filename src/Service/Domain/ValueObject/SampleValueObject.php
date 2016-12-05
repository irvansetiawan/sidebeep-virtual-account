<?php
namespace Sidebeep\Service\Domain\ValueObject;

use SidebeepService\ValueObject\ValueObjectInterface;

/**
 * @package Sidebeep\Service\Domain\ValueObject
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
class SampleValueObject implements ValueObjectInterface
{
    /**
     * @var string
     */
    private $value;

    /**
     * SampleValueObject constructor.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Return a value object taking PHP native value(s) as argument(s)
     *
     * @return static
     */
    public static function from()
    {
        $args = func_get_args();

        return new static($args[0]);
    }

    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal
     *
     * @param  ValueObjectInterface $object
     *
     * @return bool
     */
    public function compareWith(ValueObjectInterface $object)
    {
        if (get_class($object) !== get_class($this)) {
            return false;
        }
        return $this->__toString() === $object->__toString();
    }

    /**
     * Returns a string representation of the value object
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }
}