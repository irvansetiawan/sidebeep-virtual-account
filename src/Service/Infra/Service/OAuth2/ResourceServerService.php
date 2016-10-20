<?php

namespace Sidebeep\Service\Infra\Service\OAuth2;

use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use League\OAuth2\Server\ResourceServer;

/**
 * Class ResourceServerService
 * @package Sidebeep\Service\Infra\Service\OAuth2
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ResourceServerService
{
    /**
     * @var AccessTokenRepositoryInterface
     */
    private $accessTokenRepository;

    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var ResourceServer
     */
    private $server;

    /**
     * ResourceServerService constructor.
     * @param AccessTokenRepositoryInterface $accessTokenRepository
     * @param string $publicKey
     */
    public function __construct(AccessTokenRepositoryInterface $accessTokenRepository, $publicKey)
    {
        $this->accessTokenRepository = $accessTokenRepository;
        $this->publicKey = $publicKey;
    }

    /**
     * @return ResourceServer
     */
    public function server()
    {
        if (!$this->server) {
            $this->server = new ResourceServer($this->accessTokenRepository, $this->publicKey);
        }
        return $this->server;
    }
}
