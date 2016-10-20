<?php

namespace Sidebeep\Service\App\Handler;

use Sidebeep\Service\App\Command\User\AddScopeCommand;
use Sidebeep\Service\App\Command\User\DeleteCommand;
use Sidebeep\Service\App\Command\User\RemoveScopeCommand;
use Sidebeep\Service\App\Command\User\UserCommand;
use Sidebeep\Service\Domain\Model\User;
use Sidebeep\Service\Domain\Repository\UserRepository;

/**
 * Class UserHandler
 * @package Sidebeep\Service\App\Handler
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class UserHandler implements UserHandlerInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserHandler constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserCommand $command
     * @return User
     */
    public function add(UserCommand $command)
    {
        $user = User::create($command->userId, $command->username);
        $this->userRepository->add($user);
        return $user;
    }

    /**
     * @param UserCommand $command
     * @return User
     */
    public function update(UserCommand $command)
    {
        $user = $this->userRepository->ofId($command->userId);
        if ($user && !is_null($command->username)) {
             $user->setUsername($command->username);
            return $user;
        }
        return null;
    }

    /**
     * @param DeleteCommand $command
     * @return bool
     */
    public function delete(DeleteCommand $command)
    {
        $user = $this->userRepository->ofId($command->userId);
        if ($user) {
            $this->userRepository->remove($user);
            return true;
        }
        return false;
    }

    /**
     * @param AddScopeCommand $command
     * @return User
     */
    public function addScope(AddScopeCommand $command)
    {
        $user = $this->userRepository->ofId($command->userId);
        if ($user) {
            $user->addScope($command->scope);
            return $user;
        }
        return null;
    }

    /**
     * @param RemoveScopeCommand $command
     * @return User
     */
    public function removeScope(RemoveScopeCommand $command)
    {
        $user = $this->userRepository->ofId($command->userId);
        if ($user) {
            $user->removeScope($command->scope);
            return $user;
        }
        return null;
    }
}
