<?php

use Dotenv\Dotenv;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class ServiceKernel extends Kernel
{

    /**
     * @inheritdoc
     */
    public function registerBundles()
    {
        if ($this->getEnvironment() === "test") {
            if (file_exists(__DIR__ . '/../.env')) {
                $dotenv = new Dotenv(__DIR__ . '/../');
                $dotenv->overload();
            }
        }

        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new SimpleBus\SymfonyBridge\SimpleBusCommandBusBundle(),
            new OldSound\RabbitMqBundle\OldSoundRabbitMqBundle(),

            // We need doctrine for persistance handling
            // If you want to use monggo please change this to Doctrine ODM
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),

            // Enable Infrastructure Bundle
            new Sidebeep\Service\Infra\InfrastructureBundle(),

            // Enable Presentation Bundle
            new Sidebeep\Service\UI\PresentationBundle(),
        ];

        return $bundles;
    }

    /**
     * @return string
     */
    public function getRootDir()
    {
        return __DIR__;
    }

    /**
     * @return string
     */
    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    /**
     * @return string
     */
    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    /**
     * @inheritdoc
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
