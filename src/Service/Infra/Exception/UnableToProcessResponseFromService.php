<?php

namespace Sidebeep\Service\Infra\Exception;

use Sidebeep\Service\Infra\RequestHandler\Response;

/**
 * Class UnableToProcessReponseFromService
 * @package Sidebeep\Service\Infra\Exception
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class UnableToProcessResponseFromService extends \Exception
{
    /**
     * @var Response $response
     */
    private $response;

    /**
     * UnableToProcessReponseFromService constructor.
     * @param Response $response
     * @param string $message
     */
    public function __construct(Response $response, $message)
    {
        parent::__construct($message);
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
