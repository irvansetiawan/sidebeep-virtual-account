<?php
namespace Sidebeep\Service\App\Handler;

use InvalidArgumentException;
use SidebeepService\DomainEvent\AggregateRoot;
use SimpleBus\Message\Recorder\RecordsMessages;

/**
 * @package Sidebeep\Service\App\Handler
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
abstract class Handler implements HandlerInterface
{
    /**
     * @var RecordsMessages
     */
    public $eventRecorder;

    /**
     * @param AggregateRoot $class
     */
    public function runEvents(AggregateRoot $class)
    {
        if (!$class instanceof AggregateRoot) {
            throw new InvalidArgumentException();
        }

        if (!$this->eventRecorder instanceof RecordsMessages) {
            throw new InvalidArgumentException();
        }

        foreach ($class->pullDomainEvents() as $pullDomainEvent) {
            $this->eventRecorder->record($pullDomainEvent);
        }
    }
}