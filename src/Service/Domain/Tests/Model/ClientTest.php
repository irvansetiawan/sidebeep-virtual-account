<?php

namespace Sidebeep\Service\Domain\Tests\Model;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use Sidebeep\Service\Domain\Model\Client;
use Sidebeep\Service\Domain\ValueObject\ClientId;
use Sidebeep\Service\Domain\ValueObject\GrantType;

/**
 * Class ClientTest
 * @package Sidebeep\Service\Domain\Tests\Model
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateNewClient()
    {
        $clientId = $this->getMockBuilder(ClientId::class)->getMock();
        $client = Client::create($clientId, 'client-1', 'https://sidebeep.com', 'FMK6ge5m0WsqLc7Hh459FKWWaHhfR2Sx');
        $this->assertTrue($client instanceof Client);
    }

    public function testSetName()
    {
        $clientId = $this->getMockBuilder(ClientId::class)->getMock();
        $client = Client::create($clientId, 'client-1', 'https://sidebeep.com', 'FMK6ge5m0WsqLc7Hh459FKWWaHhfR2Sx');
        $newClientName = 'client-1-new';
        $client->setName($newClientName);
        $this->assertTrue($client->getName() === $newClientName);
    }

    public function testSetRedirectUri()
    {
        $clientId = $this->getMockBuilder(ClientId::class)->getMock();
        $client = Client::create($clientId, 'client-1', 'https://sidebeep.com', 'FMK6ge5m0WsqLc7Hh459FKWWaHhfR2Sx');
        $newRedirectUri = 'https://new.sidebeep.com';
        $client->setRedirectUri($newRedirectUri);
        $this->assertTrue($client->getRedirectUri() === $newRedirectUri);
    }

    public function testSetSecret()
    {
        $clientId = $this->getMockBuilder(ClientId::class)->getMock();
        $client = Client::create($clientId, 'client-1', 'https://sidebeep.com', 'FMK6ge5m0WsqLc7Hh459FKWWaHhfR2Sx');
        $newSecret = 'FMK6ge5m0WsqLc7Hh459FKWWaHhfR2Sy';
        $client->setSecret($newSecret);
        $this->assertTrue($client->validateSecret($newSecret));
    }

    public function testAddRemoveScope()
    {
        $clientId = $this->getMockBuilder(ClientId::class)->getMock();
        $client = Client::create($clientId, 'client-1', 'https://sidebeep.com', 'FMK6ge5m0WsqLc7Hh459FKWWaHhfR2Sx');
        $scope = $this->getMockBuilder(ScopeEntityInterface::class)->getMock();
        $client->addScope($scope);
        $this->assertTrue(count($client->getScopes()) === 1);
        $client->removeScope($scope);
        $this->assertTrue(count($client->getScopes()) === 0);
    }

    public function testAddRemoveGrantType()
    {
        $clientId = $this->getMockBuilder(ClientId::class)->getMock();
        $client = Client::create($clientId, 'client-1', 'https://sidebeep.com', 'FMK6ge5m0WsqLc7Hh459FKWWaHhfR2Sx');
        $grantType = GrantType::from(GrantType::AUTHORIZATION_CODE);
        $client->addGrantType($grantType);
        $this->assertTrue(count($client->getGrantType()) === 1);
        $client->removeGrantType($grantType);
        $this->assertTrue(count($client->getGrantType()) === 0);
    }

    /**
     * @param int $length
     * @return string
     */
    public function generateRandomString($length = 32)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
