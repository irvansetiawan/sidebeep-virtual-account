<?php

namespace Sidebeep\Service\App\Command;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequestFactory;

/**
 * Class AuthorizationCommand
 * @package Sidebeep\Service\App\Command
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AuthorizationCommand implements Command
{
    /**
     * @var string
     */
    public $responseType;

    /**
     * @var string
     */
    public $clientId;

    /**
     * @var string
     */
    public $redirectUri;

    /**
     * @var string
     */
    public $scope;

    /**
     * @var string
     */
    public $state;

    /**
     * AuthorizationCommand constructor.
     * @param string $responseType
     * @param string $clientId
     * @param string $redirectUri
     * @param string $scope
     * @param string $state
     */
    public function __construct($responseType, $clientId, $redirectUri, $scope, $state)
    {
        $this->responseType = $responseType;
        $this->clientId = $clientId;
        $this->redirectUri = $redirectUri;
        $this->scope = $scope;
        $this->state = $state;
    }

    /**
     * @return ServerRequestInterface
     */
    public function getPSR7Request()
    {
        $request = ServerRequestFactory::fromGlobals(
            null,
            [
                'response_type' => $this->responseType,
                'client_id' => $this->clientId,
                'redirect_uri' => $this->redirectUri,
                'scope' => $this->scope,
                'state' => $this->state,
            ]
        );
        return $request;
    }
}
