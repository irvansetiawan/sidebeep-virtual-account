<?php

namespace Sidebeep\Service\Infra\RequestHandler;

/**
 * Class Request
 * @package Sidebeep\Service\Infra\RequestHandler
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
final class Request
{
    /**
     * @var string
     */
    private $verb;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var string
     */
    private $body;

    /**
     * Request constructor.
     * @param $verb
     * @param $uri
     */
    public function __construct($verb, $uri)
    {
        $this->verb = $verb;
        $this->uri = $uri;
    }

    /**
     * @return mixed
     */
    public function getVerb()
    {
        return $this->verb;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }
}
