<?php

namespace Sidebeep\Service\Domain\Event;

/**
 * Class ClientCreated
 * @package Sidebeep\Service\Domain\Event
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ClientCreated extends DomainEvent
{

    /**
     * @return string
     */
    protected function getEventName()
    {
        return 'client_created';
    }
}
