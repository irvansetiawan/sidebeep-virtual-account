<?php
namespace Sidebeep\Service\Infra\Persistance\Doctrine\Types;

use Doctrine\ODM\MongoDB\Types\Type as MongoType;

/**
 * @package Sidebeep\Service\Infra\Persistance\Doctrine\Types
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
class SampleValueObjectType extends MongoType
{
    /**
     * @inheritdoc
     */
    public function closureToPHP()
    {
        return '$return = \Sidebeep\Service\Domain\ValueObject\SampleValueObject::from($value);';
    }

    /**
     * @inheritdoc
     */
    public function convertToDatabaseValue($value)
    {
        if (is_string($value)) {
            return $value;
        }

        return (string) $value;
    }
}