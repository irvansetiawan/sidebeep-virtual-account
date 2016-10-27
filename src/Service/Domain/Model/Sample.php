<?php

namespace Sidebeep\Service\Domain\Model;

use Sidebeep\Service\Domain\Event\SampleCreated;
use Sidebeep\Service\Domain\ValueObject\Name;
use Sidebeep\Service\Domain\ValueObject\SampleId;
use SidebeepService\DomainEvent\DomainEventPublisher;

final class Sample
{
    /**
     * @var SampleId
     */
    private $id;

    /**
     * @var Name
     */
    private $name;

    /**
     * User constructor.
     * @param SampleId $sampleId
     * @param Name $name
     */
    private function __construct(SampleId $sampleId, Name $name)
    {
        $this->id = $sampleId;
        $this->setName($name);
    }

    /**
     * @param SampleId $userId
     * @param Name $name
     * @return static
     */
    public static function create(SampleId $userId, Name $name)
    {
        $sample = new static($userId, $name);
        DomainEventPublisher::instance()->publish(new SampleCreated($sample));
        return $sample;
    }

    /**
     * @return SampleId
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param Name $name
     */
    public function setName(Name $name)
    {
        $this->name = $name;
    }
}
