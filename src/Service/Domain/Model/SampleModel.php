<?php
namespace Sidebeep\Service\Domain\Model;

use Sidebeep\Service\Domain\ValueObject\SampleValueObject;

/**
 * @package Sidebeep\Service\Domain\Model
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
class SampleModel
{
    /**
     * @var SampleValueObject
     */
    private $sampleValueObject;

    /**
     * SampleModel constructor.
     *
     * @param SampleValueObject $sampleValueObject
     */
    public function __construct(SampleValueObject $sampleValueObject)
    {
        $this->sampleValueObject = $sampleValueObject;
    }
}