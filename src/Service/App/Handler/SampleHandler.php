<?php

namespace Sidebeep\Service\App\Handler;

use Sidebeep\Service\App\Command\SampleCommand;
use Sidebeep\Service\App\Service\SyncServiceInteractionSample;

/**
 * Class AuthHandler
 * @package Sidebeep\Service\App
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class SampleHandler implements SampleHandlerInterface
{
    /**
     * You can dependency injection service or repository to handler
     * @var SyncServiceInteractionSample
     */
    private $userAuthorization;

    /**
     * SampleHandler constructor.
     * @param SyncServiceInteractionSample $userAuthorization
     */
    public function __construct(
        SyncServiceInteractionSample $userAuthorization
    ) {
        $this->userAuthorization = $userAuthorization;
    }

    /**
     * @param SampleCommand $command
     * @return mixed
     */
    public function handle(SampleCommand $command)
    {
        // Do Something
    }
}
