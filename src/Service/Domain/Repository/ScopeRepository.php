<?php

namespace Sidebeep\Service\Domain\Repository;

use Sidebeep\Service\Domain\Model\Scope;
use Sidebeep\Service\Domain\ValueObject\ScopeId;

/**
 * Interface ScopeRepository
 * @package Sidebeep\Service\Domain\Repository
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
interface ScopeRepository
{
    /**
     * @param ScopeId $id
     * @return Scope
     */
    public function ofId($id);

    /**
     * @param Scope $scope
     */
    public function add(Scope $scope);

    /**
     * @param Scope $scope
     */
    public function remove(Scope $scope);
}
