<?php

namespace Sidebeep\Service\Infra;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Sidebeep\Service\Infra\Persistance\Doctrine\Types\SampleId;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class InfrastructureBundle
 * @package Sidebeep\Service\Infra
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class InfrastructureBundle extends Bundle
{
    /**
     * @inheritdoc
     */
    public function boot()
    {
        $this->registerDbalTypes();
    }

    /**
     * Register your DBAL costum types here.
     */
    private function registerDbalTypes()
    {
        $this->registerDbalType('UserId', SampleId::class, true);
    }

    /**
     * @param $name
     * @param $typeClass
     * @param bool $commented
     * @throws \Doctrine\DBAL\DBALException
     */
    private function registerDbalType($name, $typeClass, $commented = false)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        /** @var AbstractPlatform $platform */
        $platform = $em->getConnection()->getDatabasePlatform();

        if (!Type::hasType($name)) {
            Type::addType($name, $typeClass);
            $platform->registerDoctrineTypeMapping($name, $name);
            if ($commented) {
                $platform->markDoctrineTypeCommented($name);
            }
        }
    }
}
