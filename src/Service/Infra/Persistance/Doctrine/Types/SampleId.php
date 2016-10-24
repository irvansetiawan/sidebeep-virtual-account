<?php

namespace Sidebeep\Service\Infra\Persistance\Doctrine\Types;

use Sidebeep\Service\Domain\ValueObject\SampleId as DomainSampleId;

/**
 * Class UserId
 * @package Sidebeep\Service\Infra\Persistance\Doctrine
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class SampleId extends EntityId
{

    /**
     * @return string
     */
    protected function getClassName()
    {
        return DomainSampleId::class;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'SampleId';
    }
}
