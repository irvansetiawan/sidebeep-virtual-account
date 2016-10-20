<?php

namespace Sidebeep\Service\UI\Request;

/**
 * Class Request
 * @package Sidebeep\Service\UI\Request
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
abstract class Request
{
    /**
     * @var array
     */
    protected $requestParameters;

    /**
     * TokenRequest constructor.
     * @param null $options
     */
    abstract public function __construct($options = null);

    /**
     * @return array
     */
    public function getRequestParameters()
    {
        return $this->requestParameters;
    }
}
