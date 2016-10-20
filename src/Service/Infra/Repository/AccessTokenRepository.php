<?php

namespace Sidebeep\Service\Infra\Repository;

use Doctrine\ORM\EntityRepository;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Repositories\AccessTokenRepositoryInterface;
use Sidebeep\Service\Domain\Model\AccessToken;
use Sidebeep\Service\Domain\ValueObject\AccessTokenId;

/**
 * Class AccessTokenRepository
 * @package Sidebeep\Service\Infra\Repository
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AccessTokenRepository extends EntityRepository implements AccessTokenRepositoryInterface
{

    /**
     * Create a new access token
     *
     * @param ClientEntityInterface $clientEntity
     * @param ScopeEntityInterface[] $scopes
     * @param mixed $userIdentifier
     *
     * @return AccessTokenEntityInterface
     */
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        $accessToken = new AccessToken();
        $accessToken->setClient($clientEntity);
        $accessToken->setUserIdentifier($userIdentifier);
        foreach ($scopes as $scope) {
            $accessToken->addScope($scope);
        }
        return $accessToken;
    }

    /**
     * Persists a new access token to permanent storage.
     *
     * @param AccessTokenEntityInterface $accessTokenEntity
     */
    public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity)
    {
        $this->_em->persist($accessTokenEntity);
        $this->_em->flush();
    }

    /**
     * Revoke an access token.
     *
     * @param string $tokenId
     */
    public function revokeAccessToken($tokenId)
    {
        $accessTokenId = AccessTokenId::from($tokenId);
        $accessToken = $this->find($accessTokenId);
        if ($accessToken) {
            $this->_em->remove($accessToken);
            $this->_em->flush();
        }
    }

    /**
     * Check if the access token has been revoked.
     *
     * @param string $tokenId
     *
     * @return bool Return true if this token has been revoked
     */
    public function isAccessTokenRevoked($tokenId)
    {
        $accessTokenId = AccessTokenId::from($tokenId);
        $accessToken = $this->find($accessTokenId);
        return is_null($accessToken);
    }
}
