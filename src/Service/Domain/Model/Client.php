<?php

namespace Sidebeep\Service\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use Sidebeep\Service\Domain\ValueObject\ClientId;
use Sidebeep\Service\Domain\ValueObject\GrantType;

/**
 * Client Entity
 * @package Sidebeep\Service\Domain\Model
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class Client implements ClientEntityInterface
{
    /**
     * @var ClientId
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $redirectUri;

    /**
     * @var ArrayCollection
     */
    private $scopes;

    /**
     * @var ArrayCollection
     */
    private $grantType;

    /**
     * Client constructor.
     *
     * @param ClientId $id
     * @param string $name
     * @param string $redirectUri
     * @param string $secret
     */
    public function __construct(ClientId $id, $name, $redirectUri, $secret)
    {
        $this->id = $id;
        $this->name = $name;
        $this->secret = $secret;
        $this->redirectUri = $redirectUri;
        $this->scopes = new ArrayCollection();
        $this->grantType = new ArrayCollection();
    }

    /**
     * @param ClientId $id
     * @param string $name
     * @param string $redirectUri
     * @param string $secret
     * @return static
     */
    public static function create(ClientId $id, $name, $redirectUri, $secret)
    {
        return new static($id, $name, $redirectUri, $secret);
    }

    /**
     * Get the client's identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return (string) $this->id;
    }

    /**
     * Get the client's name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the client's name.
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Returns the registered redirect URI (as a string).
     *
     * Alternatively return an indexed array of redirect URIs.
     *
     * @return string|string[]
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @param string $redirectUri
     * @return mixed
     */
    public function setRedirectUri($redirectUri)
    {
        return $this->redirectUri = urldecode($redirectUri);
    }

    /**
     * @return ArrayCollection
     */
    public function getScopes()
    {
        return $this->scopes->toArray();
    }

    /**
     * @return ArrayCollection
     */
    public function getGrantType()
    {
        return $this->grantType;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @param string $secret
     * @return bool
     */
    public function validateSecret($secret)
    {
        return $this->secret === $secret;
    }

    /**
     * @param ScopeEntityInterface $scope
     */
    public function addScope(ScopeEntityInterface $scope)
    {
        $this->scopes->add($scope);
    }

    /**
     * @param ScopeEntityInterface $scope
     */
    public function removeScope(ScopeEntityInterface $scope)
    {
        $this->scopes->removeElement($scope);
    }

    /**
     * @param GrantType $grantType
     */
    public function addGrantType(GrantType $grantType)
    {
        $this->grantType->add($grantType);
    }

    /**
     * @param GrantType $grantType
     */
    public function removeGrantType(GrantType $grantType)
    {
        $this->grantType->removeElement($grantType);
    }
}
