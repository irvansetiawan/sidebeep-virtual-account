<?php

namespace Sidebeep\Service\App\Command\Scope;

use Sidebeep\Service\Domain\ValueObject\ScopeId;

/**
 * Class DeleteCommand
 * @package Sidebeep\Service\App\Command\Scope
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class DeleteCommand
{
    /**
     * @var ScopeId
     */
    public $scopeId;

    /**
     * RemoveCommand constructor.
     * @param ScopeId $scopeId
     */
    public function __construct(ScopeId $scopeId)
    {
        $this->scopeId = $scopeId;
    }
}
