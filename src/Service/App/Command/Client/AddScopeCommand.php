<?php

namespace Sidebeep\Service\App\Command\Client;

use Sidebeep\Service\Domain\Model\Scope;
use Sidebeep\Service\Domain\ValueObject\ClientId;

/**
 * Class AddScopeCommand
 * @package Sidebeep\Service\App\Command\Client
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AddScopeCommand
{
    /**
     * @var ClientId
     */
    public $clientId;

    /**
     * @var Scope
     */
    public $scope;

    /**
     * AddScopeCommand constructor.
     * @param ClientId $clientId
     * @param Scope $scope
     */
    public function __construct(ClientId $clientId, Scope $scope)
    {
        $this->clientId = $clientId;
        $this->scope = $scope;
    }
}
