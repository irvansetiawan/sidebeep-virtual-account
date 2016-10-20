<?php

namespace Sidebeep\Service\Infra\Service\UserAuthorization;

use Sidebeep\Service\App\Exception\ServiceFailureException;
use Sidebeep\Service\App\Exception\ServiceNotAvailableException;
use Sidebeep\Service\Domain\Model\User;
use Sidebeep\Service\Domain\Service\Gateway\UserAuthorizationGatewayInterface;
use Sidebeep\Service\Infra\Exception\UnableToProcessResponseFromService;

/**
 * Class UserAuthorizationGateway
 * @package Sidebeep\Service\Infra\Service\UserAuthorization
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class UserAuthorizationGateway implements UserAuthorizationGatewayInterface
{
    /**
     * @var UserAuthorizationAdapter
     */
    private $userAuthorizationAdapter;

    /**
     * UserAuthorizationGateway constructor.
     * @param UserAuthorizationAdapter $userAuthorizationAdapter
     */
    public function __construct(UserAuthorizationAdapter $userAuthorizationAdapter)
    {
        $this->userAuthorizationAdapter = $userAuthorizationAdapter;
    }

    /**
     * @param string $username
     * @param string $password
     * @return User
     */
    public function authorizeUser($username, $password)
    {
        try {
            return $this->userAuthorizationAdapter->authorizeUser($username, $password);
        } catch (UnableToProcessResponseFromService $e) {
            $response = $e->getResponse();

            if ($response->hasConnectionFailed()) {
                $this->onServiceNotAvailable("Service not available");
            } else {
                $this->onServiceFailure(
                    sprintf(
                        "Service failed with status code : %s and body : %s",
                        $response->getStatusCode(),
                        json_encode($response->getBody())
                    )
                );
            }
        }
    }

    /**
     * @param string $message
     * @throws ServiceNotAvailableException
     */
    public function onServiceNotAvailable($message)
    {
        throw new ServiceNotAvailableException($message);
    }

    /**
     * @param string $message
     * @throws ServiceFailureException
     */
    public function onServiceFailure($message)
    {
        throw new ServiceFailureException($message);
    }
}
