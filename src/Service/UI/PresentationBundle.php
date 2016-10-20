<?php

namespace Sidebeep\Service\UI;

use Sidebeep\Service\Domain\Event\DomainEventPublisher;
use Sidebeep\Service\Domain\Event\DomainEventSubscriber;
use Sidebeep\Service\UI\DependecyInjection\PresentationExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class UIBundle
 * @package Sidebeep\Service\UI
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class PresentationBundle extends Bundle
{
    /**
     * @inheritdoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $this->setDomainEventSubscribers();
    }

    /**
     * @inheritdoc
     */
    public function getContainerExtensionClass()
    {
        return PresentationExtension::class;
    }

    private function setDomainEventSubscribers()
    {
        $domainEventSubscribers = $this->domainEventSubscribers();
        // Subscribe ALL Domain event
        foreach ($domainEventSubscribers as $domainEventSubscriber) {
            $this->setDomainEventSubscriber($domainEventSubscriber);
        }
    }

    private function setDomainEventSubscriber(DomainEventSubscriber $subscriber)
    {
        DomainEventPublisher::instance()->subscribe($subscriber);
    }

    /**
     * @return array
     */
    private function domainEventSubscribers()
    {
        return [

        ];
    }
}
