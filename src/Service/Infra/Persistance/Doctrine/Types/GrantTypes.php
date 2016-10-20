<?php

namespace Sidebeep\Service\Infra\Persistance\Doctrine\Types;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Sidebeep\Service\Domain\ValueObject\GrantType;

/**
 * Class GrantTypes
 * @package Sidebeep\Service\Infra\Persistance\Doctrine
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class GrantTypes extends Type
{

    /**
     * @inheritdoc
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getJsonTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @inheritdoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return json_encode($value);
    }

    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $collection = new ArrayCollection();
        if ($value !== null) {
            $jsonValue = json_decode($value);
            foreach ($jsonValue as $item) {
                $collection->add(GrantType::from($item));
            }
        }
        return $collection;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'GrantTypes';
    }
}
