<?php

namespace Sidebeep\Service\App\Command\Client;

use Sidebeep\Service\Domain\ValueObject\ClientId;

/**
 * Class ClientCommand
 * @package Sidebeep\Service\App\Command\Client
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ClientCommand
{
    /**
     * @var ClientId
     */
    public $clientId;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $secret;

    /**
     * @var string
     */
    public $redirectUri;

    /**
     * @var array
     */
    public $scopes;

    /**
     * @var string
     */
    public $grantType;

    /**
     * ClientCommand constructor.
     * @param ClientId $clientId
     * @param string $name
     * @param string $secret
     * @param string $redirectUri
     * @param array $scopes
     * @param string $grantType
     */
    public function __construct(
        ClientId $clientId = null,
        $name = null,
        $secret = null,
        $redirectUri = null,
        array $scopes = [],
        $grantType = null
    ) {
        $this->clientId = $clientId;
        $this->name = $name;
        $this->secret = $secret;
        $this->redirectUri = $redirectUri;
        $this->scopes = $scopes;
        $this->grantType = $grantType;
    }
}
