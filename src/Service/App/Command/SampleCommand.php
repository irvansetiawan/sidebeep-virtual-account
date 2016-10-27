<?php

namespace Sidebeep\Service\App\Command;

class SampleCommand
{
    /**
     * @var string
     */
    public $prop1;

    /**
     * @var string
     */
    public $prop2;

    /**
     * AuthorizationCommand constructor.
     * @param string $prop1
     * @param string $prop2
     */
    public function __construct($prop1, $prop2)
    {
        $this->prop1 = $prop1;
        $this->prop2= $prop2;
    }
}
