<?php

namespace Sidebeep\Service\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use Sidebeep\Service\Domain\ValueObject\UserId;

/**
 * User Entity
 * @package Sidebeep\Service\Domain\Model
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class User implements UserEntityInterface
{
    /**
     * @var UserId
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var ArrayCollection
     */
    private $scopes;

    /**
     * User constructor.
     * @param UserId $userId
     * @param string $username
     */
    public function __construct(UserId $userId, $username)
    {
        $this->id = $userId;
        $this->setUsername($username);
        $this->scopes = new ArrayCollection();
    }

    /**
     * @param UserId $userId
     * @param string $username
     * @return static
     */
    public static function create(UserId $userId, $username)
    {
        return new static($userId, $username);
    }

    /**
     * @return UserId
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Return the user's identifier.
     *
     * @return mixed
     */
    public function getIdentifier()
    {
        return (string) $this->id();
    }

    /**
     * @return array
     */
    public function getScopes()
    {
        return $this->scopes->toArray();
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
}
