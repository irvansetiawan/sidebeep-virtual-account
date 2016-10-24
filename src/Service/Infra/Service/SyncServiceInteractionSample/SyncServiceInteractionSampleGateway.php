<?php

namespace Sidebeep\Service\Infra\Service\SyncServiceInteractionSample;

use Sidebeep\Service\Domain\Model\Sample;
use Sidebeep\Service\Domain\Service\Gateway\SyncServiceInteractionSampleGatewayInterface;
use SidebeepService\RequestHandler\ServiceFailureException;
use SidebeepService\RequestHandler\ServiceNotAvailableException;
use SidebeepService\RequestHandler\UnableToProcessResponseFromService;

/**
 * Class UserAuthorizationGateway
 * @package Sidebeep\Service\Infra\Service\UserAuthorization
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class SyncServiceInteractionSampleGateway implements SyncServiceInteractionSampleGatewayInterface
{
    /**
     * @var SyncServiceInteractionSampleAdapter
     */
    private $SyncServiceInteractonSampleAdapter;

    /**
     * UserAuthorizationGateway constructor.
     * @param SyncServiceInteractionSampleAdapter $syncServiceInteractionSampleAdapter
     */
    public function __construct(SyncServiceInteractionSampleAdapter $syncServiceInteractionSampleAdapter)
    {
        $this->SyncServiceInteractonSampleAdapter = $syncServiceInteractionSampleAdapter;
    }

    /**
     * @return Sample
     */
    public function getOrPostSomethingToAnotherService()
    {
        try {
            return $this->SyncServiceInteractonSampleAdapter->getSample();
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
