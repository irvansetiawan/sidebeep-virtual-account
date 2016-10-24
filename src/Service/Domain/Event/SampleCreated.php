<?php

namespace Sidebeep\Service\Domain\Event;

use Sidebeep\Service\Domain\Model\Sample;
use SidebeepService\DomainEvent\DomainEvent;

/**
 * Class ClientCreated
 * @package Sidebeep\Service\Domain\Event
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class SampleCreated implements DomainEvent
{
    /**
     * @var Sample
     */
    private $sample;

    /**
     * SampleCreated constructor.
     * @param Sample $sample
     */
    public function __construct(Sample $sample)
    {
        $this->sample = $sample;
    }

    /**
     * @return Sample
     */
    public function getSample()
    {
        return $this->sample;
    }

    /**
     * @return string
     */
    public function getDomainEventName()
    {
        return 'sample_created';
    }
}
