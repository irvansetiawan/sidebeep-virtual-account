<?php

namespace Sidebeep\Service\Domain\ValueObject;

use SidebeepService\ValueObject\ValueObjectInterface;

class Name implements ValueObjectInterface
{
    /**
     * @var string
     */
    private $value;

    /**
     * Name constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        // Do some validation for you values, and remember value object is immutable
        $this->value = $value;
    }

    /**
     * @inheritdoc
     */
    public static function from()
    {
        $name = func_get_arg(0);
        return new static($name);
    }

    /**
     * @inheritdoc
     */
    public function compareWith(ValueObjectInterface $object)
    {
        if (get_class($this) !== get_class($object)) {
            return false;
        }
        return $this->__toString() === $object->__toString();
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->value;
    }
}
