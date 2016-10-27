<?php

namespace Sidebeep\Service\Infra\EventProcessing;


use OldSound\RabbitMqBundle\RabbitMq\Producer;

/**
 * Class EventProcessingProducer
 * @package Sidebeep\Service\Infra\EventProcessing
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class EventProcessingProducer extends Producer
{
    /**
     * @inheritdoc
     */
    public function publish($msgBody, $routingKey = '', $additionalProperties = array(), array $headers = null)
    {

        parent::publish($msgBody, $routingKey, $additionalProperties, $headers);
    }
}
