<?php

namespace Sidebeep\Service\Domain\Service\Gateway;

use Sidebeep\Service\Domain\Model\Sample;

interface SyncServiceInteractionSampleGatewayInterface
{
    /**
     * @return Sample
     */
    public function getOrPostSomethingToAnotherService();
}
