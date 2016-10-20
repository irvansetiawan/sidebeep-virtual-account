<?php

namespace Sidebeep\Service\Domain\Tests\Model;

use Sidebeep\Service\Domain\Model\Scope;
use Sidebeep\Service\Domain\ValueObject\ScopeId;

/**
 * Class ScopeTest
 * @package Sidebeep\Service\Domain\Tests\Model
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ScopeTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateNewScope()
    {
        $scopeId = $this->getMockBuilder(ScopeId::class)->setConstructorArgs(['new.scope.id'])->getMock();
        $scope = new Scope($scopeId, 'new scope');
        $this->assertTrue($scope instanceof Scope);
    }
}
