<?php

namespace Sidebeep\Service\App\Handler;

use Sidebeep\Service\App\Command\User\AddScopeCommand;
use Sidebeep\Service\App\Command\User\DeleteCommand;
use Sidebeep\Service\App\Command\User\RemoveScopeCommand;
use Sidebeep\Service\App\Command\User\UserCommand;
use Sidebeep\Service\Domain\Model\User;

/**
 * Interface UserHandlerInterface
 * @package Sidebeep\Service\App\Handler
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
interface UserHandlerInterface
{

    /**
     * @param UserCommand $command
     * @return User
     */
    public function add(UserCommand $command);

    /**
     * @param UserCommand $command
     * @return User
     */
    public function update(UserCommand $command);

    /**
     * @param DeleteCommand $command
     * @return bool
     */
    public function delete(DeleteCommand $command);

    /**
     * @param AddScopeCommand $command
     * @return User
     */
    public function addScope(AddScopeCommand $command);

    /**
     * @param RemoveScopeCommand $command
     * @return User
     */
    public function removeScope(RemoveScopeCommand $command);
}
