<?php

namespace Sidebeep\Service\Domain\Tests\Model;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use Sidebeep\Service\Domain\Model\AuthCode;

/**
 * Class AuthCodeTest
 * @package Sidebeep\Service\Domain\Tests\Model
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AuthCodeTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateNewAuthCode()
    {
        $authCode = new AuthCode();
        $this->assertTrue($authCode instanceof AuthCode);
    }

    public function testSetRedirectUri()
    {
        $authCode = new AuthCode();
        $redirectUri = 'https://sidebeep.com';
        $authCode->setRedirectUri($redirectUri);

        $this->assertTrue($authCode->getRedirectUri() === $redirectUri);
    }

    public function testSetIdentifier()
    {
        $authCode = new AuthCode();
        $authCodeIdString = '0f9c5b6e-ebd0-417c-8442-2015b60a50f2';

        $authCode->setIdentifier($authCodeIdString);

        $this->assertTrue($authCode->getIdentifier() === $authCodeIdString);
    }

    public function testSetExpiryDateTime()
    {
        $authCode = new AuthCode();
        $dateTime = new \DateTime();
        $authCode->setExpiryDateTime($dateTime);
        $this->assertTrue($authCode->getExpiryDateTime()->format(DATE_ISO8601) === $dateTime->format(DATE_ISO8601));
    }

    public function testSetUserIdentifier()
    {
        $authCode = new AuthCode();
        $userId = '0f9c5b6e-ebd0-417c-8442-2015b60a50f2';
        $authCode->setUserIdentifier($userId);

        $this->assertTrue($authCode->getUserIdentifier() === $userId);
    }

    public function testSetClient()
    {
        $authCode = new AuthCode();
        $client = $this->getMockBuilder(ClientEntityInterface::class)->getMock();
        $authCode->setClient($client);

        $this->assertTrue($authCode->getClient() instanceof ClientEntityInterface);
    }

    public function testAddScope()
    {
        $authCode = new AuthCode();
        $scope = $this->getMockBuilder(ScopeEntityInterface::class)->getMock();
        $authCode->addScope($scope);

        $this->assertTrue(count($authCode->getScopes()) === 1);
    }
}
