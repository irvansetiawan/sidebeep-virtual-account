<?php

namespace Sidebeep\Service\Infra\Repository;

use Doctrine\ORM\EntityRepository;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Repositories\ScopeRepositoryInterface;
use Sidebeep\Service\Domain\Model\Scope;
use Sidebeep\Service\Domain\Repository\ScopeRepository as DomainScopeRepository;
use Sidebeep\Service\Domain\ValueObject\ScopeId;

/**
 * Class ScopeRepository
 * @package Sidebeep\Service\Infra\Repository
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ScopeRepository extends EntityRepository implements DomainScopeRepository, ScopeRepositoryInterface
{

    /**
     * @param ScopeId $id
     * @return Scope
     */
    public function ofId($id)
    {
        return $this->find($id);
    }

    /**
     * @param Scope $scope
     */
    public function add(Scope $scope)
    {
        $this->_em->persist($scope);
        $this->_em->flush();
    }

    /**
     * @param Scope $scope
     */
    public function remove(Scope $scope)
    {
        $this->_em->remove($scope);
        $this->_em->flush();
    }

    /**
     * Return information about a scope.
     *
     * @param string $identifier The scope identifier
     *
     * @return ScopeEntityInterface
     */
    public function getScopeEntityByIdentifier($identifier)
    {
        $scopeId = ScopeId::from($identifier);
        return $this->ofId($scopeId);
    }

    /**
     * Given a client, grant type and optional user identifier
     * validate the set of scopes requested are valid and optionally
     * append additional scopes or remove requested scopes.
     *
     * @param ScopeEntityInterface[] $scopes
     * @param string $grantType
     * @param ClientEntityInterface $clientEntity
     * @param null|string $userIdentifier
     *
     * @return ScopeEntityInterface[]
     */
    public function finalizeScopes(
        array $scopes,
        $grantType,
        ClientEntityInterface $clientEntity,
        $userIdentifier = null
    ) {
        // TODO: Implement finalizeScopes() method.
        return $scopes;
    }
}
