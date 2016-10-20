<?php

namespace Sidebeep\Service\Infra\Repository;

use Doctrine\ORM\EntityRepository;
use League\OAuth2\Server\Entities\AuthCodeEntityInterface;
use League\OAuth2\Server\Repositories\AuthCodeRepositoryInterface;
use Sidebeep\Service\Domain\Model\AuthCode;
use Sidebeep\Service\Domain\ValueObject\AuthCodeId;

/**
 * Class AuthCodeRepository
 * @package Sidebeep\Service\Infra\Repository
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AuthCodeRepository extends EntityRepository implements AuthCodeRepositoryInterface
{

    /**
     * Creates a new AuthCode
     *
     * @return AuthCodeEntityInterface
     */
    public function getNewAuthCode()
    {
        return new AuthCode();
    }

    /**
     * Persists a new auth code to permanent storage.
     *
     * @param AuthCodeEntityInterface $authCodeEntity
     */
    public function persistNewAuthCode(AuthCodeEntityInterface $authCodeEntity)
    {
        $this->_em->persist($authCodeEntity);
        $this->_em->flush();
    }

    /**
     * Revoke an auth code.
     *
     * @param string $codeId
     */
    public function revokeAuthCode($codeId)
    {
        $authCodeId = AuthCodeId::from($codeId);
        $authCode = $this->find($authCodeId);

        if ($authCode) {
            $this->_em->remove($authCode);
            $this->_em->flush();
        }
    }

    /**
     * Check if the auth code has been revoked.
     *
     * @param string $codeId
     *
     * @return bool Return true if this code has been revoked
     */
    public function isAuthCodeRevoked($codeId)
    {
        $authCodeId = AuthCodeId::from($codeId);
        $authCode = $this->find($authCodeId);
        return is_null($authCode);
    }
}
