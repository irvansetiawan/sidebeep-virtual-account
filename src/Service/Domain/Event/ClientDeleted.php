<?php

namespace Sidebeep\Service\Domain\Event;

/**
 * Class ClientDeleted
 * @package Sidebeep\Service\Domain\Event
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ClientDeleted extends DomainEvent
{

    /**
     * @return string
     */
    protected function getEventName()
    {
        return 'client_deleted';
    }
}
