<?php

namespace Sidebeep\Service\Infra\RequestHandler;

/**
 * Class Response
 * @package Sidebeep\Service\Infra\RequestHandler
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
final class Response
{
    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var string
     */
    private $body;

    /**
     * @var bool
     */
    private $connectionFailed;

    /**
     * Response constructor.
     * @param int $statusCode
     */
    public function __construct($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return Response
     */
    public static function buildConnectionFailedResponse()
    {
        $response = new self(0);
        $response->connectionFailed = true;
        return $response;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getHeader($name)
    {
        $header = isset($this->headers[$name]) ? $this->headers[$name] : null;
        if (null !== $header && is_array($header)) {
            return $header[0];
        }
        return $header;
    }

    /**
     * @param $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return bool
     */
    public function hasConnectionFailed()
    {
        return $this->connectionFailed;
    }
}
