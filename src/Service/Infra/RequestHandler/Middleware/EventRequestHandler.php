<?php

namespace Sidebeep\Service\Infra\RequestHandler\Middleware;

use Sidebeep\Service\Infra\RequestHandler\Event\ReceivedResponse;
use Sidebeep\Service\Infra\RequestHandler\Request;
use Sidebeep\Service\Infra\RequestHandler\RequestHandler;
use Sidebeep\Service\Infra\RequestHandler\Response;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class EventRequestHandler
 * @package Sidebeep\Service\Infra\RequestHandler\Middleware
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class EventRequestHandler implements RequestHandler
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var RequestHandler
     */
    private $requestHandler;

    /**
     * EventRequestHandler constructor.
     * @param EventDispatcherInterface $eventDispatcher
     * @param RequestHandler $requestHandler
     */
    public function __construct(EventDispatcherInterface $eventDispatcher, RequestHandler $requestHandler)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->requestHandler = $requestHandler;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request)
    {
        $response = $this->requestHandler->handle($request);
        $this->eventDispatcher->dispatch('request_handler.received_response', new ReceivedResponse($response));

        return $response;
    }
}
