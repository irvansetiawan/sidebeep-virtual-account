<?php

namespace Sidebeep\Service\Infra\Persistance\Doctrine\Types;

use Sidebeep\Service\Domain\ValueObject\ClientId as DomainClientId;

/**
 * Class ClientId
 * @package Sidebeep\Service\Infra\Persistance\Doctrine
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ClientId extends EntityId
{

    /**
     * @return string
     */
    protected function getClassName()
    {
        return DomainClientId::class;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'ClientId';
    }
}
