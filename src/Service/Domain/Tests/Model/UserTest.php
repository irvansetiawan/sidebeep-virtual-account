<?php

namespace Sidebeep\Service\Domain\Tests\Model;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use Sidebeep\Service\Domain\Model\User;
use Sidebeep\Service\Domain\ValueObject\UserId;

/**
 * Class UserTest
 * @package Sidebeep\Service\Domain\Tests\Model
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateNewUser()
    {
        $userId = $this->getMockBuilder(UserId::class)->getMock();
        $user = User::create($userId, 'user@sidebeep.com');
        $this->assertTrue($user instanceof User);
    }

    public function testSetUsername()
    {
        $userId = $this->getMockBuilder(UserId::class)->getMock();
        $user = User::create($userId, 'user@sidebeep.com');
        $newUserName = 'newUser@sidebeep.com';
        $user->setUsername($newUserName);

        $this->assertTrue($user->getUsername() === $newUserName);
    }

    public function testAddRemoveScope()
    {
        $userId = $this->getMockBuilder(UserId::class)->getMock();
        $user = User::create($userId, 'user@sidebeep.com');
        $scope = $this->getMockBuilder(ScopeEntityInterface::class)->getMock();
        $user->addScope($scope);
        $this->assertTrue(count($user->getScopes()) === 1);
        $user->removeScope($scope);
        $this->assertTrue(count($user->getScopes()) === 0);
    }
}
