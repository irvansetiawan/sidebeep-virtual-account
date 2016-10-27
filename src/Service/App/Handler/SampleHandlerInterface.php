<?php

namespace Sidebeep\Service\App\Handler;

use Sidebeep\Service\App\Command\SampleCommand;

/**
 * Always create interface for your handler, because someday we need to reimplement handler when something change.
 */
interface SampleHandlerInterface
{
    /**
     * @param SampleCommand $command
     * @return mixed
     */
    public function handle(SampleCommand $command);
}
