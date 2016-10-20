<?php

namespace Sidebeep\Service\Domain\Tests\Model;

use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use Sidebeep\Service\Domain\Model\AccessToken;

/**
 * Class AccessTokenTest
 * @package Sidebeep\Service\Domain\Tests\Model
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AccessTokenTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateNewAccessToken()
    {
        $accessToken = new AccessToken();
        $this->assertTrue($accessToken instanceof AccessToken);
    }

    public function testSetIdentifier()
    {
        $accessToken = new AccessToken();
        $accessTokenIdString = '0f9c5b6e-ebd0-417c-8442-2015b60a50f2';
        $accessToken->setIdentifier($accessTokenIdString);

        $this->assertTrue($accessToken->getIdentifier() === $accessTokenIdString);
    }

    public function testSetExpiryDateTime()
    {
        $accessToken = new AccessToken();
        $dateTime = new \DateTime();
        $accessToken->setExpiryDateTime($dateTime);
        $this->assertTrue($accessToken->getExpiryDateTime()->format(DATE_ISO8601) === $dateTime->format(DATE_ISO8601));
    }

    public function testSetUserIdentifier()
    {
        $accessToken = new AccessToken();
        $userId = '0f9c5b6e-ebd0-417c-8442-2015b60a50f2';
        $accessToken->setUserIdentifier($userId);

        $this->assertTrue($accessToken->getUserIdentifier() === $userId);
    }

    public function testSetClient()
    {
        $accessToken = new AccessToken();
        $client = $this->getMockBuilder(ClientEntityInterface::class)->getMock();
        $accessToken->setClient($client);

        $this->assertTrue($accessToken->getClient() instanceof ClientEntityInterface);
    }

    public function testAddScope()
    {
        $accessToken = new AccessToken();
        $scope = $this->getMockBuilder(ScopeEntityInterface::class)->getMock();
        $accessToken->addScope($scope);

        $this->assertTrue(count($accessToken->getScopes()) === 1);
    }
}
