<?php
namespace Sidebeep\Service\App\Command\Sample;

use Sidebeep\Service\App\Command\AppCommandInterface;

/**
 * @package Sidebeep\Service\App\Command\Sample
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
class SampleCommand implements AppCommandInterface
{
    /**
     * @var string
     */
    public $property;

    /**
     * SampleCommand constructor.
     *
     * @param string $property
     */
    public function __construct($property)
    {
        $this->property = $property;
    }

}