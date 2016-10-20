<?php

namespace Sidebeep\Service\Domain\Tests\Model;

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use Sidebeep\Service\Domain\Model\RefreshToken;

/**
 * Class RefreshTokenTest
 * @package Sidebeep\Service\Domain\Tests\Model
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class RefreshTokenTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateNewRefreshToken()
    {
        $refreshToken = new RefreshToken();
        $this->assertTrue($refreshToken instanceof RefreshToken);
    }

    public function testSetIdentifier()
    {
        $refreshToken = new RefreshToken();
        $refreshTokenId = '0f9c5b6e-ebd0-417c-8442-2015b60a50f2';
        $refreshToken->setIdentifier($refreshTokenId);
        $this->assertTrue($refreshToken->getIdentifier() === $refreshTokenId);
    }


    public function testSetExpiryDateTime()
    {
        $refreshToken = new RefreshToken();
        $dateTime = new \DateTime();
        $refreshToken->setExpiryDateTime($dateTime);
        $this->assertTrue($refreshToken->getExpiryDateTime()->format(DATE_ISO8601) === $dateTime->format(DATE_ISO8601));
    }

    public function testSetAccessToken()
    {
        $refreshToken = new RefreshToken();
        $accessToken = $this->getMockBuilder(AccessTokenEntityInterface::class)->getMock();
        $refreshToken->setAccessToken($accessToken);
        $this->assertTrue($refreshToken->getAccessToken() instanceof AccessTokenEntityInterface);
    }
}
