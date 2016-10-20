<?php

namespace Sidebeep\Service\App\Service;

use Sidebeep\Service\App\Exception\MicroServiceIntegrationException;
use Sidebeep\Service\App\Exception\UnableToAuthenticateUser;
use Sidebeep\Service\Domain\Model\User;
use Sidebeep\Service\Domain\Service\Gateway\UserAuthorizationGatewayInterface;

/**
 * Class UserAuthorization
 * @package Sidebeep\Service\App\Service
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class UserAuthorization
{
    /**
     * @var UserAuthorizationGatewayInterface
     */
    private $userAuthorizationGateway;

    /**
     * UserAuthorization constructor.
     * @param UserAuthorizationGatewayInterface $userAuthorizationGateway
     */
    public function __construct(UserAuthorizationGatewayInterface $userAuthorizationGateway)
    {
        $this->userAuthorizationGateway = $userAuthorizationGateway;
    }

    /**
     * @param string $username
     * @param string $password
     * @return User
     * @throws UnableToAuthenticateUser
     */
    public function authorizeUser($username, $password)
    {
        try {
            return $this->userAuthorizationGateway->authorizeUser($username, $password);
        } catch (MicroServiceIntegrationException $e) {
            throw new UnableToAuthenticateUser(
                sprintf("Unable to authenticate user %s caused by %s", $username, $e->getMessage())
            );
        }
    }
}
