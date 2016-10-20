<?php

namespace Sidebeep\Service\App\Handler;

use Sidebeep\Service\App\Command\Scope\DeleteCommand;
use Sidebeep\Service\App\Command\Scope\ScopeCommand;
use Sidebeep\Service\Domain\Model\Scope;

/**
 * Interface ScopeHandlerInterface
 * @package Sidebeep\Service\App\Handler
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
interface ScopeHandlerInterface
{
    /**
     * @param ScopeCommand $command
     * @return Scope
     */
    public function add(ScopeCommand $command);

    /**
     * @param DeleteCommand $command
     * @return Scope
     */
    public function delete(DeleteCommand $command);
}
