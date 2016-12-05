<?php
namespace Sidebeep\Service\App\Subscriber\Sample;

use Sidebeep\Service\App\Subscriber\SubscriberInterface;
use Sidebeep\Service\Domain\Repository\SampleModelRepositoryInterface;
use SidebeepService\DomainEvent\DomainEvent;

/**
 * @package Sidebeep\Service\App\Subscriber\Sample
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
class SampleSubscriber implements SubscriberInterface
{
    /**
     * @var SampleModelRepositoryInterface
     */
    private $sampleRepository;

    /**
     * SampleSubscriber constructor.
     *
     * @param SampleModelRepositoryInterface $sampleRepository
     */
    public function __construct(SampleModelRepositoryInterface $sampleRepository)
    {
        $this->sampleRepository = $sampleRepository;
    }

    /**
     * @param DomainEvent $event
     */
    public function handle(DomainEvent $event)
    {
        // TODO: Implement handle() method.
    }
}