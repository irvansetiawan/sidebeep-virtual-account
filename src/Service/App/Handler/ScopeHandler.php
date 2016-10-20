<?php

namespace Sidebeep\Service\App\Handler;

use Sidebeep\Service\App\Command\Scope\DeleteCommand;
use Sidebeep\Service\App\Command\Scope\ScopeCommand;
use Sidebeep\Service\Domain\Model\Scope;
use Sidebeep\Service\Domain\Repository\ScopeRepository;

/**
 * Class ScopeHandler
 * @package Sidebeep\Service\App\Handler
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ScopeHandler implements ScopeHandlerInterface
{
    /**
     * @var ScopeRepository
     */
    private $scopeRepository;

    /**
     * ScopeHandler constructor.
     * @param ScopeRepository $scopeRepository
     */
    public function __construct(ScopeRepository $scopeRepository)
    {
        $this->scopeRepository = $scopeRepository;
    }

    /**
     * @param ScopeCommand $command
     * @return Scope
     */
    public function add(ScopeCommand $command)
    {
        $scope = Scope::create($command->scopeId, $command->description);
        $this->scopeRepository->add($scope);
        return $scope;
    }

    /**
     * @param DeleteCommand $command
     * @return Scope
     */
    public function delete(DeleteCommand $command)
    {
        $scope = $this->scopeRepository->ofId($command->scopeId);
        if ($scope) {
            $this->scopeRepository->remove($scope);
            return true;
        }
        return false;
    }
}
