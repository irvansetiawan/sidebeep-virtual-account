<?php

namespace Sidebeep\Service\Domain\Event;

/**
 * Class DomainEvent
 * @package Sidebeep\Service\Domain\Event
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
abstract class DomainEvent
{
    const SERVICE_IDENTIFIER = 'auth';

    /**
     * @var mixed
     */
    private $event;

    /**
     * DomainEvent constructor.
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->event = $data;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @return string
     */
    abstract protected function getEventName();

    /**
     * @return string
     */
    public function getEventId()
    {
        return self::SERVICE_IDENTIFIER . '.' . $this->getEventName();
    }
}
