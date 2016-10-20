<?php

namespace Sidebeep\Service\UI\Adapter;

use Sidebeep\Service\App\Command\TokenCommand;
use Sidebeep\Service\Domain\ValueObject\ClientId;
use Sidebeep\Service\Domain\ValueObject\GrantType;
use Sidebeep\Service\UI\Request\Request;

/**
 * Class TokenCommandAdapter
 * @package Sidebeep\Service\UI\Adapter
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class TokenCommandRequestAdapter implements RequestAdapter
{

    /**
     * @param Request $request
     * @return TokenCommand
     */
    public function createCommandFromRequest(Request $request)
    {
        $parameters = $request->getRequestParameters();

        $command = new TokenCommand(
            GrantType::from($parameters['grant_type']),
            ClientId::from($parameters['client_id']),
            $parameters['client_secret'],
            isset($parameters['scope']) ? $parameters['scope']: null,
            isset($parameters['username']) ? $parameters['username']: null,
            isset($parameters['password']) ? $parameters['password']: null,
            isset($parameters['redirect_uri']) ? $parameters['redirect_uri']: null,
            isset($parameters['code']) ? $parameters['code']: null
        );

        return $command;
    }
}
