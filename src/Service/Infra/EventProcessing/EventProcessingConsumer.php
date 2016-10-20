<?php

namespace Sidebeep\Service\Infra\EventProcessing;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class EventProcessingConsumer
 * @package Sidebeep\Service\Infra\EventProcessing
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class EventProcessingConsumer implements ConsumerInterface
{

    /**
     * @param AMQPMessage $msg The message
     * @return mixed false to reject and requeue, any other value to acknowledge
     */
    public function execute(AMQPMessage $msg)
    {
        // TODO: Implement execute() method.
    }
}
