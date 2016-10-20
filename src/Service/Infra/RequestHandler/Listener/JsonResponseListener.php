<?php

namespace Sidebeep\Service\Infra\RequestHandler\Listener;

use Sidebeep\Service\Infra\RequestHandler\Event\ReceivedResponse;

/**
 * Class JsonResponseListener
 * @package Sidebeep\Service\Infra\RequestHandler\Listener
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class JsonResponseListener
{
    /**
     * @param ReceivedResponse $receivedResponse
     * @throws \Exception
     */
    public function onReceivedResponse(ReceivedResponse $receivedResponse)
    {
        $response = $receivedResponse->getResponse();
        if (false === strpos($response->getHeader('Content-Type'), 'application/json')) {
            return;
        }

        $body = $response->getBody();
        $json = json_decode($body, true);

        if (json_last_error()) {
            throw new \Exception("Invalid JSON in response body: $body");
        }

        $response->setBody($json);
    }
}
