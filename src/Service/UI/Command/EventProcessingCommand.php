<?php

namespace Sidebeep\Service\UI\Command;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class EventProcessingCommand
 * @package Sidebeep\Service\UI\Command
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class EventProcessingCommand extends ContainerAwareCommand
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->addArgument('event', InputArgument::REQUIRED)
            ->setName('service:event:processing')
        ;

    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = json_decode(base64_decode($input->getArgument('event')));
        $message = new AMQPMessage($data->body, $data->properties);

        /** @var ConsumerInterface $consumer */
        $consumer = $this->getContainer()->get('service.infrastructure.event_processing_consumer');

        if (false == $consumer->execute($message)) {
            exit(1);
        }
        exit(0);
    }
}
