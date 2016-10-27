<?php

namespace Sidebeep\Service\Domain\Repository;

use Sidebeep\Service\Domain\Model\Sample;
use Sidebeep\Service\Domain\ValueObject\SampleId;

interface SampleRepository
{
    /**
     * @param SampleId $id
     * @return Sample
     */
    public function ofId(SampleId $id);

    /**
     * @param Sample $user
     */
    public function add(Sample $user);

    /**
     * @param Sample $user
     */
    public function remove(Sample $user);
}
