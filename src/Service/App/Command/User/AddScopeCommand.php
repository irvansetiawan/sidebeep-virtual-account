<?php

namespace Sidebeep\Service\App\Command\User;

use Sidebeep\Service\Domain\Model\Scope;
use Sidebeep\Service\Domain\ValueObject\UserId;

/**
 * Class AddScopeCommand
 * @package Sidebeep\Service\App\Command\User
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AddScopeCommand
{

    /**
     * @var UserId
     */
    public $userId;

    /**
     * @var Scope
     */
    public $scope;

    /**
     * AddScopeCommand constructor.
     * @param UserId $userId
     * @param Scope $scope
     */
    public function __construct(UserId $userId, Scope $scope)
    {
        $this->userId = $userId;
        $this->scope = $scope;
    }
}
