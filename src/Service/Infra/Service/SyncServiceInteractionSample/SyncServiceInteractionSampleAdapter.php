<?php

namespace Sidebeep\Service\Infra\Service\SyncServiceInteractionSample;

use Sidebeep\Service\Domain\Model\Sample;
use SidebeepService\RequestHandler\Request;
use SidebeepService\RequestHandler\RequestHandler;

class SyncServiceInteractionSampleAdapter
{
    /**
     * @var RequestHandler $requestHandler
     */
    private $requestHandler;

    /**
     * @var string
     */
    private $userAuthorizationUri;

    /**
     * UserAuthorizationAdapter constructor.
     * @param RequestHandler $requestHandler
     * @param string $userAuthorizationUri
     */
    public function __construct(RequestHandler $requestHandler, $userAuthorizationUri)
    {
        $this->requestHandler = $requestHandler;
        $this->userAuthorizationUri = $userAuthorizationUri;
    }

    /**
     * @return Sample
     */
    public function getSample()
    {
        $translator = new SyncServiceInteractionSampleTranslator();

        $request = new Request("GET", $this->userAuthorizationUri);

        $request->addHeader("Accept", "application/json");
        $request->addHeader("Content-Type", "application/json");

        $response = $this->requestHandler->handle($request);

        return $translator->toUserFromResponse($response);
    }
}
