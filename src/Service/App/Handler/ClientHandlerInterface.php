<?php

namespace Sidebeep\Service\App\Handler;

use Sidebeep\Service\App\Command\Client\AddGrantTypeCommand;
use Sidebeep\Service\App\Command\Client\AddScopeCommand;
use Sidebeep\Service\App\Command\Client\ClientCommand;
use Sidebeep\Service\App\Command\Client\DeleteCommand;
use Sidebeep\Service\App\Command\Client\RemoveGrantTypeCommand;
use Sidebeep\Service\App\Command\Client\RemoveScopeCommand;
use Sidebeep\Service\Domain\Model\Client;

/**
 * Interface ClientHandlerInterface
 * @package Sidebeep\Service\App\Handler
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
interface ClientHandlerInterface
{
    /**
     * @param ClientCommand $command
     * @return Client
     */
    public function add(ClientCommand $command);

    /**
     * @param DeleteCommand $command
     * @return bool
     */
    public function delete(DeleteCommand $command);

    /**
     * @param AddScopeCommand $command
     * @return Client
     */
    public function addScope(AddScopeCommand $command);

    /**
     * @param RemoveScopeCommand $command
     * @return Client
     */
    public function removeScope(RemoveScopeCommand $command);

    /**
     * @param AddGrantTypeCommand $command
     * @return Client
     */
    public function addGrantType(AddGrantTypeCommand $command);

    /**
     * @param removeGrantTypeCommand $command
     * @return Client
     */
    public function removeGrantType(removeGrantTypeCommand $command);
}
