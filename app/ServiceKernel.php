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
            // Symfony and Friends
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            new FOS\RestBundle\FOSRestBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new OldSound\RabbitMqBundle\OldSoundRabbitMqBundle(),
            new SidebeepService\Bundles\SidebeepServiceBundle\SidebeepServiceBundle(),
            new SimpleBus\SymfonyBridge\SimpleBusEventBusBundle(),

            // We need doctrine for persistance handling
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),

            // Mongodb bundle
            new Doctrine\Bundle\MongoDBBundle\DoctrineMongoDBBundle(),

            // Enable Command BUS
            new SimpleBus\SymfonyBridge\SimpleBusCommandBusBundle(),

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
