<?php

namespace Sidebeep\Service\UI\Request;

use Sidebeep\Service\Domain\ValueObject\GrantType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TokenRequest
 * @package Sidebeep\Service\UI\Request
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class TokenRequest extends Request
{
    /**
     * TokenRequest constructor.
     * @param null $options
     */
    public function __construct($options = null)
    {
        $options = null !== $options ? $options : [];

        $resolver = new OptionsResolver();

        $resolver->setDefined([
            'grant_type',
            'client_id',
            'client_secret',
            'scope',
            'username',
            'password',
            'redirect_uri',
            'code'
        ]);

        $resolver->setRequired([
            'grant_type',
            'client_id',
            'client_secret'
        ]);

        $resolver->setAllowedTypes('grant_type', 'string');
        $resolver->setAllowedTypes('client_id', 'string');
        $resolver->setAllowedTypes('client_secret', 'string');
        $resolver->setAllowedTypes('scope', 'string');
        $resolver->setAllowedTypes('username', 'string');
        $resolver->setAllowedTypes('password', 'string');
        $resolver->setAllowedTypes('redirect_uri', 'string');
        $resolver->setAllowedTypes('code', 'string');

        $resolver->setAllowedValues('grant_type', [
            GrantType::AUTHORIZATION_CODE,
            GrantType::CLIENT_CREDENTIALS,
            GrantType::PASSWORD,
            GrantType::IMPLICT,
            GrantType::REFRESH_TOKEN
        ]);

        $this->requestParameters = $resolver->resolve($options);
    }
}
