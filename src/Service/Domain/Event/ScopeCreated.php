<?php

namespace Sidebeep\Service\Domain\Event;

/**
 * Class ScopeCreated
 * @package Sidebeep\Service\Domain\Event
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ScopeCreated extends DomainEvent
{

    /**
     * @return string
     */
    protected function getEventName()
    {
        return 'scope_created';
    }
}
