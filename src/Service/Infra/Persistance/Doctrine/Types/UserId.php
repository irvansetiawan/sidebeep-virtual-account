<?php

namespace Sidebeep\Service\Infra\Persistance\Doctrine\Types;

use Sidebeep\Service\Domain\ValueObject\UserId as DomainUserId;

/**
 * Class UserId
 * @package Sidebeep\Service\Infra\Persistance\Doctrine
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class UserId extends EntityId
{

    /**
     * @return string
     */
    protected function getClassName()
    {
        return DomainUserId::class;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'UserId';
    }
}
