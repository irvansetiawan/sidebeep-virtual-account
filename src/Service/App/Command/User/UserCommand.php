<?php

namespace Sidebeep\Service\App\Command\User;

use Sidebeep\Service\Domain\ValueObject\UserId;

/**
 * Class NewUserCommand
 * @package Sidebeep\Service\App\Command\User
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class UserCommand
{
    /**
     * @var UserId
     */
    public $id;

    /**
     * @var string
     */
    public $username;

    /**
     * @var array
     */
    public $scopes;

    /**
     * NewUserCommand constructor.
     * @param UserId $userId
     * @param string $username
     * @param array $scopes
     */
    public function __construct(UserId $userId = null, $username = null, array $scopes = [])
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->scopes = $scopes;
    }
}
