<?php

namespace Sidebeep\Service\UI;

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
    }

    /**
     * @inheritdoc
     */
    public function getContainerExtensionClass()
    {
        return PresentationExtension::class;
    }
}
