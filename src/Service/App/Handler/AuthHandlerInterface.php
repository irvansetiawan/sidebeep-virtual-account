<?php

namespace Sidebeep\Service\App\Handler;

use League\OAuth2\Server\RequestTypes\AuthorizationRequest;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sidebeep\Service\App\Command\AuthorizationCommand;
use Sidebeep\Service\Domain\Model\User;

/**
 * Interface Handler
 * @package Sidebeep\Service\App
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
interface AuthHandlerInterface
{
    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function getToken(ServerRequestInterface $request);

    /**
     * @param AuthorizationCommand $command
     * @return AuthorizationRequest
     */
    public function validateAuthorization(AuthorizationCommand $command);

    /**
     * @param string $username
     * @param string $password
     * @return User
     */
    public function getUser($username, $password);

    /**
     * @param AuthorizationRequest $authRequest
     * @param User $user
     * @return ResponseInterface
     */
    public function processAuthRequest(AuthorizationRequest $authRequest, User $user);

    /**
     * @param ServerRequestInterface $request
     * @return ServerRequestInterface
     */
    public function validateAccessToken(ServerRequestInterface $request);
}
