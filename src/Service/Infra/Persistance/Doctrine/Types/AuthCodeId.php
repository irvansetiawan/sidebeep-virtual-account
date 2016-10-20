<?php

namespace Sidebeep\Service\Infra\Persistance\Doctrine\Types;

use Sidebeep\Service\Domain\ValueObject\AuthCodeId as DomainAuthCodeId;

/**
 * Class AuthCodeId
 * @package Sidebeep\Service\Infra\Persistance\Doctrine
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AuthCodeId extends EntityId
{

    /**
     * @return string
     */
    protected function getClassName()
    {
        return DomainAuthCodeId::class;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'AuthCodeId';
    }
}
