<?php

namespace Sidebeep\Service\Infra\Service\OAuth2;

use League\OAuth2\Server\AuthorizationServer;
use League\OAuth2\Server\CryptKey;
use League\OAuth2\Server\Grant\AuthCodeGrant;
use League\OAuth2\Server\Grant\ClientCredentialsGrant;
use League\OAuth2\Server\Grant\ImplicitGrant;
use League\OAuth2\Server\Grant\PasswordGrant;
use League\OAuth2\Server\Grant\RefreshTokenGrant;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use Zend\Diactoros\Response;

/**
 * Class AuthorizationServerService
 * @package Sidebeep\Service\Infra\Service\OAuth2
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AuthorizationServerService
{
    const CLIENT_REPOSITORY = 'clientRepository';
    const USER_REPOSITORY = 'userRepository';
    const SCOPE_REPOSITORY = 'scopeRepository';
    const ACCESS_TOKEN_REPOSITORY = 'accessTokenRepository';
    const AUTH_CODE_REPOSITORY = 'authCodeRepository';

    /**
     * @var ClientRepositoryInterface
     */
    private $clientRepository;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var ScopeRepositoryInterface
     */
    private $scopeRepository;

    /**
     * @var AccessTokenRepositoryInterface
     */
    private $accessTokenRepository;

    /**
     * @var RefreshTokenRepositoryInterface
     */
    private $refreshTokenRepository;

    /**
     * @var AuthCodeRepositoryInterface
     */
    private $authCodeRepository;

    /**
     * @var string|CryptKey
     */
    private $privateKey;

    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var AuthorizationServer
     */
    private $server;

    /**
     * AuthController constructor.
     * @param ClientRepositoryInterface $clientRepository
     * @param UserRepositoryInterface $userRepository
     * @param ScopeRepositoryInterface $scopeRepository
     * @param AccessTokenRepositoryInterface $accessTokenRepository
     * @param RefreshTokenRepositoryInterface $refreshTokenRepository
     * @param AuthCodeRepositoryInterface $authCodeRepository
     * @param string $privateKey
     * @param bool $privateKeyHavePassPhrase
     * @param string $privateKeyPassPhrase
     * @param string $publicKey
     */
    public function __construct(
        ClientRepositoryInterface $clientRepository,
        UserRepositoryInterface $userRepository,
        ScopeRepositoryInterface $scopeRepository,
        AccessTokenRepositoryInterface $accessTokenRepository,
        RefreshTokenRepositoryInterface $refreshTokenRepository,
        AuthCodeRepositoryInterface $authCodeRepository,
        $privateKey,
        $privateKeyHavePassPhrase,
        $privateKeyPassPhrase,
        $publicKey
    ) {
        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
        $this->scopeRepository = $scopeRepository;
        $this->accessTokenRepository = $accessTokenRepository;
        $this->refreshTokenRepository = $refreshTokenRepository;
        $this->authCodeRepository = $authCodeRepository;
        $this->privateKey = $privateKey;
        if ((bool) $privateKeyHavePassPhrase) {
            $this->privateKey = new CryptKey($privateKey, $privateKeyPassPhrase);
        }
        $this->publicKey = $publicKey;

        $this->server = new AuthorizationServer(
            $this->clientRepository,
            $this->accessTokenRepository,
            $this->scopeRepository,
            $privateKey,
            $publicKey
        );

        $this->setGrants();
    }

    /**
     * @return AuthorizationServer
     */
    public function server()
    {
        return $this->server;
    }

    private function setGrants()
    {
        $this->setPasswordGrant();

        $this->setClientCredentiralsGrant();

        $this->setAuthorizationCodeGrant();

        $this->setImplictGrant();

        $this->setRefreshTokenGrant();
    }

    private function setPasswordGrant()
    {
        $grant = new PasswordGrant(
            $this->userRepository,
            $this->refreshTokenRepository
        );
        $grant->setRefreshTokenTTL(new \DateInterval('P1M'));
        $this->server()->enableGrantType($grant, new \DateInterval('PT1H'));
    }

    private function setClientCredentiralsGrant()
    {
        $this->server()->enableGrantType(
            new ClientCredentialsGrant(),
            new \DateInterval('PT1H')
        );
    }

    private function setAuthorizationCodeGrant()
    {
        $grant = new AuthCodeGrant(
            $this->authCodeRepository,
            $this->refreshTokenRepository,
            new \DateInterval('PT10M') // authorization codes will expire after 10 minutes
        );
        $grant->setRefreshTokenTTL(new \DateInterval('P1M'));
        $this->server()->enableGrantType(
            $grant,
            new \DateInterval('PT1H') // access tokens will expire after 1 hour
        );
    }

    private function setImplictGrant()
    {
        $this->server()->enableGrantType(
            new ImplicitGrant(new \DateInterval('PT1H')),
            new \DateInterval('PT1H')
        );
    }

    private function setRefreshTokenGrant()
    {
        $grant = new RefreshTokenGrant($this->refreshTokenRepository);
        $grant->setRefreshTokenTTL(new \DateInterval('P1M'));
        $this->server()->enableGrantType(
            $grant,
            new \DateInterval('PT1H')
        );
    }

    /**
     * @return RefreshTokenRepositoryInterface
     */
    public function getRefreshTokenRepository()
    {
        return $this->refreshTokenRepository;
    }
}
