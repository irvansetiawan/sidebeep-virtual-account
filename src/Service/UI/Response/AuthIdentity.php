<?php

namespace Sidebeep\Service\UI\Response;

use Psr\Http\Message\ServerRequestInterface;

/**
 * Class AuthIdentity
 * @package Sidebeep\Service\UI\Response
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AuthIdentity
{

    /**
     * @var string
     */
    public $accessTokenId;

    /**
     * @var string
     */
    public $clientId;

    /**
     * @var string
     */
    public $userId;

    /**
     * @var array
     */
    public $scopes;

    /**
     * AuthIdentity constructor.
     * @param string $accessTokenId
     * @param string $clientId
     * @param string $userId
     * @param array $scopes
     */
    public function __construct($accessTokenId, $clientId, $userId = null, array $scopes = [])
    {
        $this->accessTokenId = $accessTokenId;
        $this->clientId = $clientId;
        $this->userId = $userId;
        $this->scopes = $scopes;
    }

    /**
     * @param ServerRequestInterface $request
     * @return static
     */
    public static function fromRequest(ServerRequestInterface $request)
    {
        return new static(
            $request->getAttribute('oauth_access_token_id'),
            $request->getAttribute('oauth_client_id'),
            $request->getAttribute('oauth_user_id'),
            $request->getAttribute('oauth_scopes')
        );
    }
}
