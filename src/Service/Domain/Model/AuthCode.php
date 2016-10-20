<?php

namespace Sidebeep\Service\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use Sidebeep\Service\Domain\ValueObject\AuthCodeId;
use Sidebeep\Service\Domain\ValueObject\UserId;

/**
 * AuthCode Entity
 * @package Sidebeep\Service\Domain\Model
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AuthCode implements AuthCodeEntityInterface
{

    /**
     * @var AuthCodeId
     */
    private $id;

    /**
     * @var string
     */
    private $redirectUri;

    /**
     * @var \DateTime
     */
    private $expiredAt;

    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var ClientEntityInterface
     */
    private $client;

    /**
     * @var ArrayCollection
     */
    private $scopes;

    /**
     * AuthCode constructor.
     */
    public function __construct()
    {
        $this->id = new AuthCodeId();
        $this->scopes = new ArrayCollection();
        $expiryDateTime = new \DateTime();
        /** Default 7 hour expirity */
        $expiryDateTime->add(new \DateInterval('PT7H'));
        $this->setExpiryDateTime($expiryDateTime);
    }

    /**
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @param string $uri
     */
    public function setRedirectUri($uri)
    {
        $this->redirectUri = $uri;
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
            $this->id = new AuthCodeId($identifier);
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
     * Set the identifier of the user associated with the token.
     *
     * @param string|int $identifier The identifier of the user
     */
    public function setUserIdentifier($identifier)
    {
        $this->userId = UserId::from($identifier);
    }

    /**
     * Get the token user's identifier.
     *
     * @return string|int
     */
    public function getUserIdentifier()
    {
        return (string) $this->userId;
    }

    /**
     * Get the client that the token was issued to.
     *
     * @return ClientEntityInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set the client that the token was issued to.
     *
     * @param \League\OAuth2\Server\Entities\ClientEntityInterface $client
     */
    public function setClient(ClientEntityInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Associate a scope with the token.
     *
     * @param \League\OAuth2\Server\Entities\ScopeEntityInterface $scope
     */
    public function addScope(ScopeEntityInterface $scope)
    {
        $this->scopes->add($scope);
    }

    /**
     * Return an array of scopes associated with the token.
     *
     * @return ScopeEntityInterface[]
     */
    public function getScopes()
    {
        return $this->scopes->toArray();
    }
}
