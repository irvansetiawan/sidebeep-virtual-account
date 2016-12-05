<?php

namespace Sidebeep\Service\Infra;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Doctrine\ODM\MongoDB\Types\Type;

/**
 * Class InfrastructureBundle
 * @package Sidebeep\Service\Infra
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class InfrastructureBundle extends Bundle
{
    /**
     * InfrastructureBundle constructor.
     */
    public function __construct()
    {
        $this->registerOdmCustomTypes();
    }

    /**
     * @inheritdoc
     */
    public function boot()
    {
    }

    /**
     * Register your DBAL custom types here.
     */
    private function registerOdmCustomTypes()
    {
        Type::registerType('AvailableTime', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\AvailableTimeType');
        Type::registerType('BeeperId', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\BeeperIdType');
        Type::registerType('Date', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\DateType');
        Type::registerType('EndAt', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\EndAtType');
        Type::registerType('OrderId', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\OrderIdType');
        Type::registerType('SchedulesId', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\SchedulesIdType');
        Type::registerType('ServiceId', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\ServiceIdType');
        Type::registerType('SiderId', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\SiderIdType');
        Type::registerType('StartAt', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\StartAtType');
        Type::registerType('SerializedStartAt', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\SerializedStartAtType');
        Type::registerType('SerializedEndAt', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\SerializedEndAtType');
        Type::registerType('Firstname', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\FirstNameType');
        Type::registerType('Lastname', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\LastNameType');
        Type::registerType('UserId', 'Sidebeep\Service\Infra\Persistance\Doctrine\Types\UserIdType');
    }
}
