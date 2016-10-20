<?php

namespace Sidebeep\Service\App\Command\User;

use Sidebeep\Service\Domain\ValueObject\UserId;

/**
 * Class DeleteUserCommand
 * @package Sidebeep\Service\App\Command\User
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class DeleteCommand
{
    /**
     * @var UserId
     */
    public $userId;

    /**
     * DeleteUserCommand constructor.
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }
}
