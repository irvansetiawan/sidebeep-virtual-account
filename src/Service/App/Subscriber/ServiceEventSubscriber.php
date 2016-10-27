<?php

namespace Sidebeep\Service\App\Subscriber;

use OldSound\RabbitMqBundle\RabbitMq\Producer;
use Sidebeep\Service\Domain\Event\DomainEvent;
use Sidebeep\Service\Domain\Event\DomainEventSubscriber;

/**
 * Class ServiceEventSubscriber
 * @package Sidebeep\Service\App\Subscriber
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
abstract class ServiceEventSubscriber implements DomainEventSubscriber
{
    /**
     * @var Producer
     */
    private $producer;

    /**
     * ServiceEventSubscriber constructor.
     * @param Producer $producer
     */
    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param DomainEvent $event
     */
    public function handle(DomainEvent $event)
    {
        $msgBody = $this->getServiceEventMessage();
        $this->producer->publish(serialize([
            'event_id' => $event->getEventId(),
            'data' => $msgBody
        ]));
    }

    /**
     * @return array
     */
    abstract protected function getServiceEventMessage();
}
