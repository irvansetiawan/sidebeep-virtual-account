<?php

namespace Sidebeep\Service\Domain\Event;

/**
 * Class DomainEventPublisher
 * @package Sidebeep\Service\Domain\Event
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class DomainEventPublisher
{
    /**
     * @var DomainEventSubscriber[]
     */
    private $subscribers;

    /**
     * @var DomainEventSubscriber
     */
    private static $instance = null;

    private $id = 0;

    /**
     * @return static
     */
    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    /**
     * DomainEventPublisher constructor.
     */
    private function __construct()
    {
        $this->subscribers = [];
    }

    public function __clone()
    {
        throw new \BadMethodCallException('Clone is not supported');
    }

    /**
     * @param DomainEventSubscriber $subscriber
     * @return int
     */
    public function subscribe(DomainEventSubscriber $subscriber)
    {
        $id = $this->id;
        $this->subscribers[$id] = $subscriber;
        $this->id++;

        return $id;
    }

    /**
     * @param $id
     * @return null|DomainEventSubscriber
     */
    public function ofId($id)
    {
        return isset($this->subscribers[$id]) ? $this->subscribers[$id] : null;
    }

    /**
     * @param $id
     */
    public function unsubscribe($id)
    {
        unset($this->subscribers[$id]);
    }

    /**
     * @param DomainEvent $event
     */
    public function publish(DomainEvent $event)
    {
        foreach ($this->subscribers as $subscriber) {
            if ($subscriber->isSubscribedTo($event)) {
                $subscriber->handle($event);
            }
        }
    }
}
