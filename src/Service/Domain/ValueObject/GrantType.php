<?php

namespace Sidebeep\Service\Domain\ValueObject;

/**
 * Class GrantType
 * @package Sidebeep\Service\Domain\ValueObject
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class GrantType extends Enum
{
    const CLIENT_CREDENTIALS = 'client_credentials';
    const PASSWORD = 'password';
    const AUTHORIZATION_CODE = 'authorization_code';
    const IMPLICT = 'implicit';
    const REFRESH_TOKEN = 'refresh_token';
}
