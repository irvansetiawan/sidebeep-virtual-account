<?php

namespace Sidebeep\Service\Domain\Model;

use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use Sidebeep\Service\Domain\ValueObject\RefreshTokenId;

/**
 * RefreshToken Entity
 * @package Sidebeep\Service\Domain\Model
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class RefreshToken implements RefreshTokenEntityInterface
{
    /**
     * @var RefreshTokenId
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $expiredAt;

    /**
     * @var AccessTokenEntityInterface
     */
    private $accessToken;

    /**
     * RefreshToken constructor.
     */
    public function __construct()
    {
        $this->id = new RefreshTokenId();
        $expiryDateTime = new \DateTime();
        /** Default 1 month expirity */
        $expiryDateTime->add(new \DateInterval('P1M'));
        $this->setExpiryDateTime($expiryDateTime);
    }

    /**
     * Get the token's identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return (string) $this->id;
    }

    /**
     * Set the token's identifier.
     *
     * @param $identifier
     */
    public function setIdentifier($identifier)
    {
        if ($this->id === null) {
            $this->id = RefreshTokenId::from($identifier);
        }
    }

    /**
     * Get the token's expiry date time.
     *
     * @return \DateTime
     */
    public function getExpiryDateTime()
    {
        return $this->expiredAt;
    }

    /**
     * Set the date time when the token expires.
     *
     * @param \DateTime $dateTime
     */
    public function setExpiryDateTime(\DateTime $dateTime)
    {
        $this->expiredAt = $dateTime;
    }

    /**
     * Set the access token that the refresh token was associated with.
     *
     * @param \League\OAuth2\Server\Entities\AccessTokenEntityInterface $accessToken
     */
    public function setAccessToken(AccessTokenEntityInterface $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Get the access token that the refresh token was originally associated with.
     *
     * @return \League\OAuth2\Server\Entities\AccessTokenEntityInterface
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
