<?php

namespace Sidebeep\Service\Domain\Event;

/**
 * Class UserCreated
 * @package Sidebeep\Service\Domain\Event
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class UserCreated extends DomainEvent
{

    /**
     * @return string
     */
    protected function getEventName()
    {
        return 'user_created';
    }
}
