<?php

namespace Sidebeep\Service\Infra\Persistance\Doctrine\Types;

use Sidebeep\Service\Domain\ValueObject\RefreshTokenId as DomainRefreshTokenId;

/**
 * Class RefreshTokenId
 * @package Sidebeep\Service\Infra\Persistance\Doctrine
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class RefreshTokenId extends EntityId
{

    /**
     * @return string
     */
    protected function getClassName()
    {
        return DomainRefreshTokenId::class;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'RefreshTokenId';
    }
}
