<?php

namespace Sidebeep\Service\App\Subscriber;

use Sidebeep\Service\Domain\Event\ClientCreated;
use Sidebeep\Service\Domain\Event\DomainEvent;

/**
 * Class ClientCreatedSubscriber
 * @package Sidebeep\Service\App\Subscriber
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ClientCreatedSubscriber extends ServiceEventSubscriber
{

    /**
     * @param DomainEvent $event
     * @return bool
     */
    public function isSubscribedTo(DomainEvent $event)
    {
        return get_class($event) === ClientCreated::class;
    }

    /**
     * @return array
     */
    protected function getServiceEventMessage()
    {
        // TODO: Implement getServiceEventMessage() method.
    }
}
