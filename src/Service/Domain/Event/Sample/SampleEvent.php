<?php
namespace Sidebeep\Service\Domain\Event\Sample;

use SidebeepService\DomainEvent\DomainEvent;

/**
 * @package Sidebeep\Service\Domain\Event\Sample
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
class SampleEvent implements DomainEvent
{
    /**
     * @return string
     */
    public function getDomainEventName()
    {
        return 'sample.event';
    }
}