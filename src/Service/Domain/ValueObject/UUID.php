<?php

namespace Sidebeep\Service\Domain\ValueObject;

use Ramsey\Uuid\Uuid as BaseUUID;
use Sidebeep\Service\Domain\Exception\InvalidArgumentException;

/**
 * UUID Value Object
 * @package Sidebeep\Service\Domain\ValueObject
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class UUID implements ValueObjectInterface
{

    /**
     * @var string
     */
    protected $value;

    /**
     * UUID constructor.
     * @param null $uuid
     */
    public function __construct($uuid = null)
    {
        $uuidInstance = BaseUUID::uuid4();
        if (!empty($uuid)) {
            try {
                $uuidInstance = BaseUuid::fromString($uuid);
            } catch (\InvalidArgumentException $e) {
                throw new InvalidArgumentException($e->getMessage());
            }
        }
        $this->value = $uuidInstance->toString();
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
