<?php

namespace Sidebeep\Service\Domain\ValueObject;

use Sidebeep\Service\Domain\Exception\InvalidArgumentException;

/**
 * Class ScopeId
 * @package Sidebeep\Service\Domain\ValueObject
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ScopeId implements ValueObjectInterface
{
    const MAX_SCOPE_ID_LENGTH = 128;
    const SCOPE_ID_RULE = "/^[a-zA-Z\d-_.]+$/";

    /**
     * @var string
     */
    private $value;

    /**
     * ScopeId constructor.
     * @param string $value
     */
    public function __construct($value)
    {
        if (strlen($value) > self::MAX_SCOPE_ID_LENGTH) {
            throw new InvalidArgumentException('Scope id can\'t be longer than ' . self::MAX_SCOPE_ID_LENGTH);
        }

        $matchValues = [];
        preg_match(self::SCOPE_ID_RULE, $value, $matchValues);
        if (count($matchValues) < 1) {
            throw new InvalidArgumentException('invalid scope id');
        }

        $this->value = $value;
    }

    /**
     * Returns a value object taking PHP native value(s) as argument(s).
     *
     * @return static
     */
    public static function from()
    {
        $id = func_get_arg(0);
        return new static($id);
    }

    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal
     *
     * @param  ValueObjectInterface $object
     * @return bool
     */
    public function compareWith(ValueObjectInterface $object)
    {
        if (get_class($this) !== get_class($object)) {
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
