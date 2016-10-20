<?php

namespace Sidebeep\Service\App\Command\Client;

use Sidebeep\Service\Domain\ValueObject\ClientId;

/**
 * Class DeleteCommand
 * @package Sidebeep\Service\App\Command\Client
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class DeleteCommand
{
    /**
     * @var ClientId
     */
    public $clientId;

    /**
     * DeleteCommand constructor.
     * @param ClientId $clientId
     */
    public function __construct(ClientId $clientId)
    {
        $this->clientId = $clientId;
    }
}
