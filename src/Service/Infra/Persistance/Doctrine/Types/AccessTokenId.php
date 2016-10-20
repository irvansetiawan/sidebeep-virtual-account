<?php

namespace Sidebeep\Service\Infra\Persistance\Doctrine\Types;

use Sidebeep\Service\Domain\ValueObject\AccessTokenId as DomainAccessTokenId;

/**
 * Class AccessTokenId
 * @package Sidebeep\Service\Infra\Persistance\Doctrine
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AccessTokenId extends EntityId
{

    /**
     * @return string
     */
    protected function getClassName()
    {
        return DomainAccessTokenId::class;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'AccessTokenId';
    }
}
