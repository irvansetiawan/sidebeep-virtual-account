<?php

namespace Sidebeep\Service\App\Service;

use Sidebeep\Service\App\Exception\MicroServiceIntegrationException;
use Sidebeep\Service\App\Exception\UnableToAuthenticateUser;
use Sidebeep\Service\Domain\Service\Gateway\SyncServiceInteractionSampleGatewayInterface;

class SyncServiceInteractionSample implements SyncServiceInteractionSampleInterface
{
    /**
     * @var SyncServiceInteractionSampleGatewayInterface
     */
    private $userAuthorizationGateway;

    /**
     * UserAuthorization constructor.
     * @param SyncServiceInteractionSampleGatewayInterface $userAuthorizationGateway
     */
    public function __construct(SyncServiceInteractionSampleGatewayInterface $userAuthorizationGateway)
    {
        $this->userAuthorizationGateway = $userAuthorizationGateway;
    }

    public function getOrPostSomethingToAnotherService()
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
