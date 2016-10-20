<?php

namespace Sidebeep\Service\App\Handler;

use League\OAuth2\Server\RequestTypes\AuthorizationRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sidebeep\Service\App\Command\AuthorizationCommand;
use Sidebeep\Service\App\Service\UserAuthorization;
use Sidebeep\Service\Domain\Model\User;
use Sidebeep\Service\Infra\Service\OAuth2\AuthorizationServerService;
use Sidebeep\Service\Infra\Service\OAuth2\ResourceServerService;
use Zend\Diactoros\Response;

/**
 * Class AuthHandler
 * @package Sidebeep\Service\App
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AuthHandler implements AuthHandlerInterface
{
    /**
     * @var AuthorizationServerService
     */
    private $authorizationServerService;

    /**
     * @var ResourceServerService
     */
    private $resourceServerService;

    /**
     * @var UserAuthorization
     */
    private $userAuthorization;

    /**
     * AuthHandler constructor.
     * @param AuthorizationServerService $authorizationServerService
     * @param ResourceServerService $resourceServerService
     * @param UserAuthorization $userAuthorization
     */
    public function __construct(
        AuthorizationServerService $authorizationServerService,
        ResourceServerService $resourceServerService,
        UserAuthorization $userAuthorization
    ) {
        $this->authorizationServerService = $authorizationServerService;
        $this->resourceServerService = $resourceServerService;
        $this->userAuthorization = $userAuthorization;
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     * @throws \League\OAuth2\Server\Exception\OAuthServerException
     */
    public function getToken(ServerRequestInterface $request)
    {
        $response = new Response();
        $this->authorizationServerService->server()->respondToAccessTokenRequest($request, $response);
        return $response;
    }

    /**
     * @param AuthorizationCommand $command
     * @return AuthorizationRequest
     */
    public function validateAuthorization(AuthorizationCommand $command)
    {
        $request = $command->getPSR7Request();
        $authRequest = $this->authorizationServerService->server()->validateAuthorizationRequest($request);
        return $authRequest;
    }

    /**
     * @param string $username
     * @param string $password
     * @return User
     */
    public function getUser($username, $password)
    {
        return $this->userAuthorization->authorizeUser($username, $password);
    }

    /**
     * @param AuthorizationRequest $authRequest
     * @param User $user
     * @return ResponseInterface
     */
    public function processAuthRequest(AuthorizationRequest $authRequest, User $user)
    {
        $server = $this->authorizationServerService->server();
        $authRequest->setUser($user);
        $authRequest->setAuthorizationApproved(true);
        $response = new Response();
        return $server->completeAuthorizationRequest($authRequest, $response);
    }

    /**
     * @param ServerRequestInterface $request
     * @return ServerRequestInterface
     */
    public function validateAccessToken(ServerRequestInterface $request)
    {
        $server = $this->resourceServerService->server();
        return $server->validateAuthenticatedRequest($request);
    }
}
