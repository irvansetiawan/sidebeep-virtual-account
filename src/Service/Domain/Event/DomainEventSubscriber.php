<?php

namespace Sidebeep\Service\Domain\Event;

/**
 * Interface DomainEventSubscriber
 * @package Sidebeep\Service\Domain\Event
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
interface DomainEventSubscriber
{

    /**
     * @param DomainEvent $event
     */
    public function handle(DomainEvent $event);

    /**
     * @param DomainEvent $event
     * @return bool
     */
    public function isSubscribedTo(DomainEvent $event);
}
