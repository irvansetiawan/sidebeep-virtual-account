<?php

namespace Sidebeep\Service\Infra\RequestHandler\Middleware;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Sidebeep\Service\Infra\RequestHandler\Request;
use Sidebeep\Service\Infra\RequestHandler\RequestHandler;
use Sidebeep\Service\Infra\RequestHandler\Response;

/**
 * Class GuzzleRequestHandler
 * @package Sidebeep\Service\Infra\RequestHandler\Middleware
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class GuzzleRequestHandler implements RequestHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * GuzzleRequestHandler constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request)
    {
        $guzzleRequest = $this->client->createRequest($request->getVerb(), $request->getUri(), [
            'headers' => $request->getHeaders(),
            'body' => $request->getBody()
        ]);

        try {
            $guzzleRequest = $this->client->send($guzzleRequest);
            $response = new Response($guzzleRequest->getStatusCode());
            $response->setHeaders($guzzleRequest->getHeaders());
            $response->setBody($guzzleRequest->getBody()->__toString());

            return $response;
        } catch (ConnectException $e) {
            return $this->handleConnectionExcption();
        } catch (RequestException $e) {
            return $this->handleRequestException($e);
        }
    }

    /**
     * @return Response
     */
    private function handleConnectionExcption()
    {
        return Response::buildConnectionFailedResponse();
    }

    /**
     * @param RequestException $e
     * @return Response
     */
    private function handleRequestException(RequestException $e)
    {
        if ($e->hasResponse()) {
            $guzzleReponse = $e->getResponse();

            $response = new Response($guzzleReponse->getStatusCode());
            $response->setHeaders($guzzleReponse->getHeaders());

            if (null !== $guzzleReponse->getBody()) {
                $response->setBody($guzzleReponse->getBody()->__toString());
            }

            return $response;
        }
        return Response::buildConnectionFailedResponse();
    }
}
