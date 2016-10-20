<?php

namespace Sidebeep\Service\Infra\RequestHandler\Event;

use Sidebeep\Service\Infra\RequestHandler\Response;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class ReceiveResponse
 * @package Sidebeep\Service\Infra\RequestHandler\Event
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ReceivedResponse extends Event
{
    /**
     * @var Response
     */
    private $response;

    /**
     * ReceiveResponse constructor.
     * @param Response $response
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
