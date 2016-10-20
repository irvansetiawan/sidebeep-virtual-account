<?php

namespace Sidebeep\Service\App\Command\Scope;

use Sidebeep\Service\Domain\ValueObject\ScopeId;

/**
 * Class ScopeCommand
 * @package Sidebeep\Service\App\Command\Scope
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ScopeCommand
{
    /**
     * @var ScopeId
     */
    public $scopeId;

    /**
     * @var string
     */
    public $description;

    /**
     * AddCommand constructor.
     * @param ScopeId $scopeId
     * @param string $description
     */
    public function __construct(ScopeId $scopeId, $description)
    {
        $this->scopeId = $scopeId;
        $this->description = $description;
    }
}
