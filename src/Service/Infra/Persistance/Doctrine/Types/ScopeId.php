<?php

namespace Sidebeep\Service\Infra\Persistance\Doctrine\Types;

use Sidebeep\Service\Domain\ValueObject\ScopeId as DomainScopeId;

/**
 * Class ScopeId
 * @package Sidebeep\Service\Infra\Persistance\Doctrine
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ScopeId extends EntityId
{

    /**
     * @return string
     */
    protected function getClassName()
    {
        return DomainScopeId::class;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'ScopeId';
    }
}
