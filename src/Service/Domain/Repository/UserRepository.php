<?php

namespace Sidebeep\Service\Domain\Repository;

use Sidebeep\Service\Domain\Model\User;
use Sidebeep\Service\Domain\ValueObject\UserId;

/**
 * Interface UserRepository
 * @package Sidebeep\Service\Domain\Repository
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
interface UserRepository
{
    /**
     * @param UserId $id
     * @return User
     */
    public function ofId(UserId $id);

    /**
     * @param $username
     * @return User
     */
    public function ofUsername($username);

    /**
     * @param User $user
     */
    public function add(User $user);

    /**
     * @param User $user
     */
    public function remove(User $user);
}
