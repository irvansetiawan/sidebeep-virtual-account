<?php

namespace Sidebeep\Service\Infra\Repository;

use Doctrine\ORM\EntityRepository;
use League\OAuth2\Server\Entities\RefreshTokenEntityInterface;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use Sidebeep\Service\Domain\Model\RefreshToken;
use Sidebeep\Service\Domain\ValueObject\RefreshTokenId;

/**
 * Class RefreshTokenRepository
 * @package Sidebeep\Service\Infra\Repository
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class RefreshTokenRepository extends EntityRepository implements RefreshTokenRepositoryInterface
{

    /**
     * Creates a new refresh token
     *
     * @return RefreshTokenEntityInterface
     */
    public function getNewRefreshToken()
    {
        return new RefreshToken();
    }

    /**
     * Create a new refresh token_name.
     *
     * @param RefreshTokenEntityInterface $refreshTokenEntity
     */
    public function persistNewRefreshToken(RefreshTokenEntityInterface $refreshTokenEntity)
    {
        $this->_em->persist($refreshTokenEntity);
        $this->_em->flush();
    }

    /**
     * Revoke the refresh token.
     *
     * @param string $tokenId
     */
    public function revokeRefreshToken($tokenId)
    {
        $refreshTokenId = RefreshTokenId::from($tokenId);
        $refreshToken = $this->find($refreshTokenId);
        if ($refreshToken) {
            $this->_em->remove($refreshToken);
            $this->_em->flush();
        }
    }

    /**
     * Check if the refresh token has been revoked.
     *
     * @param string $tokenId
     *
     * @return bool Return true if this token has been revoked
     */
    public function isRefreshTokenRevoked($tokenId)
    {
        $refreshTokenId = RefreshTokenId::from($tokenId);
        $refreshToken = $this->find($refreshTokenId);
        return is_null($refreshToken);
    }
}
