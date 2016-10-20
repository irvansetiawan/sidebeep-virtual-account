<?php

namespace Sidebeep\Service\App\Command\Client;

use Sidebeep\Service\Domain\ValueObject\ClientId;
use Sidebeep\Service\Domain\ValueObject\GrantType;

/**
 * Class RemoveGrantTypeCommand
 * @package Sidebeep\Service\App\Command\Client
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class RemoveGrantTypeCommand
{
    /**
     * @var ClientId
     */
    public $clientId;

    /**
     * @var GrantType
     */
    public $grantType;

    /**
     * RemoveGrantTypeCommand constructor.
     * @param ClientId $clientId
     * @param GrantType $grantType
     */
    public function __construct(ClientId $clientId, GrantType $grantType)
    {
        $this->clientId = $clientId;
        $this->grantType = $grantType;
    }
}
