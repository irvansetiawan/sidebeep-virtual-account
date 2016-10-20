<?php

namespace Sidebeep\Service\Domain\Event;

/**
 * Class ScopeDeleted
 * @package Sidebeep\Service\Domain\Event
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ScopeDeleted extends DomainEvent
{

    /**
     * @return string
     */
    protected function getEventName()
    {
        return 'scope_deleted';
    }
}
