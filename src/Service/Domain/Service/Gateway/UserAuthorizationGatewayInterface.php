<?php

namespace Sidebeep\Service\Domain\Service\Gateway;

use Sidebeep\Service\Domain\Model\User;

/**
 * Interface UserAuthorizationGatewayInterface
 * @package Sidebeep\Service\Domain\Service\Gateway
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
interface UserAuthorizationGatewayInterface
{
    /**
     * @param string $username
     * @param string $password
     * @return User
     */
    public function authorizeUser($username, $password);
}
