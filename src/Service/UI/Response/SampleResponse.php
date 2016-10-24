<?php

namespace Sidebeep\Service\UI\Response;

class SampleResponse
{
    public $prop_1;
    public $prop_2;

    /**
     * SampleResponse constructor.
     */
    public function __construct($prop_1, $prop_2)
    {
        $this->prop_1 = $prop_1;
        $this->prop_2 = $prop_2;
    }

    public static function getSampleResponseFrom(array $array)
    {
        return new static($array['prop_1'], $array['prop_2']);
    }
}
