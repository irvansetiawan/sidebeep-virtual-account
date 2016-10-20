<?php

namespace Sidebeep\Service\UI\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class ProducerCommand
 * @package Sidebeep\Service\UI\Command
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ProducerCommand extends ContainerAwareCommand
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('service:producer:dummy')
        ;
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $msg = [
            'event_id' => 'user_created',
            'user' => [

            ]
        ];
        $this->getContainer()->get('old_sound_rabbit_mq.service_event_producer')->publish(serialize($msg));
        exit(0);
    }
}
