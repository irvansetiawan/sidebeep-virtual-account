<?php

namespace Sidebeep\Service\Infra\Repository;

use Doctrine\ORM\EntityRepository;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use Sidebeep\Service\App\Service\UserAuthorization;
use Sidebeep\Service\Domain\Model\User;
use Sidebeep\Service\Domain\Repository\UserRepository as DomainUserRepository;
use Sidebeep\Service\Domain\ValueObject\UserId;
use Sidebeep\Service\Infra\Exception\InvalidArgumentException;

/**
 * Class UserRepository
 * @package Sidebeep\Service\Infra\Repository
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class UserRepository extends EntityRepository implements DomainUserRepository, UserRepositoryInterface
{
    /**
     * @var UserAuthorization
     */
    private $userAuthorization = null;

    /**
     * @param UserAuthorization $userAuthorization
     */
    public function setUserAuthorization(UserAuthorization $userAuthorization)
    {
        $this->userAuthorization = $userAuthorization;
    }

    /**
     * @param UserId $id
     * @return User
     */
    public function ofId(UserId $id)
    {
        return $this->find($id);
    }

    /**
     * @param $username
     * @return User
     */
    public function ofUsername($username)
    {
        return $this->findOneBy(['username' => $username]);
    }

    /**
     * @param User $user
     */
    public function add(User $user)
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }

    /**
     * @param User $user
     */
    public function remove(User $user)
    {
        $this->_em->remove($user);
        $this->_em->flush();
    }

    /**
     * Get a user entity.
     *
     * @param string $username
     * @param string $password
     * @param string $grantType The grant type used
     * @param ClientEntityInterface $clientEntity
     *
     * @return UserEntityInterface
     */
    public function getUserEntityByUserCredentials(
        $username,
        $password,
        $grantType,
        ClientEntityInterface $clientEntity
    ) {
        if (is_null($this->userAuthorization)) {
            throw new InvalidArgumentException('User credential validator service has not been set!');
        }

        if (!$this->userAuthorization->authorizeUser($username, $password)) {
            return null;
        }

        $user = $this->ofUsername($username);

        if (!$user) {
            return null;
        }

        return $user;
    }
}
