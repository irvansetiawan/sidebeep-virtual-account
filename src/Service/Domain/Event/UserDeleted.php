<?php

namespace Sidebeep\Service\Domain\Event;

/**
 * Class UserDeleted
 * @package Sidebeep\Service\Domain\Event
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class UserDeleted extends DomainEvent
{

    /**
     * @return string
     */
    protected function getEventName()
    {
        return 'user_deleted';
    }
}
