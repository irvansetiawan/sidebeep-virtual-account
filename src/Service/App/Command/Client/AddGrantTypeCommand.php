<?php

namespace Sidebeep\Service\App\Command\Client;

use Sidebeep\Service\Domain\ValueObject\ClientId;
use Sidebeep\Service\Domain\ValueObject\GrantType;

/**
 * Class AddGrantTypeCommand
 * @package Sidebeep\Service\App\Command\Client
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AddGrantTypeCommand
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
     * AddGrantTypeCommand constructor.
     * @param ClientId $clientId
     * @param GrantType $grantType
     */
    public function __construct(ClientId $clientId, GrantType $grantType)
    {
        $this->clientId = $clientId;
        $this->grantType = $grantType;
    }
}
