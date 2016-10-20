<?php

namespace Sidebeep\Service\Domain\ValueObject;

/**
 * Interface for Value Object
 * @package Sidebeep\Service\Domain\ValueObject
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
interface ValueObjectInterface
{
    /**
     * Returns a value object taking PHP native value(s) as argument(s).
     *
     * @return ValueObjectInterface
     */
    public static function from();

    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal
     *
     * @param  ValueObjectInterface $object
     * @return bool
     */
    public function compareWith(ValueObjectInterface $object);

    /**
     * Returns a string representation of the value object
     *
     * @return string
     */
    public function __toString();
}
