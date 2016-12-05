<?php

namespace Sidebeep\Service\App\Subscriber;

use SidebeepService\DomainEvent\DomainEvent;

/**
 * Interface SubscriberInterface
 * @package Sidebeep\Service\App\Subscriber
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
interface SubscriberInterface
{
    /**
     * @param DomainEvent $event
     */
    public function handle(DomainEvent $event);
}
