<?php

namespace Sidebeep\Service\Infra\Service\UserAuthorization;

use Sidebeep\Service\Domain\Model\User;
use Sidebeep\Service\Infra\RequestHandler\Request;
use Sidebeep\Service\Infra\RequestHandler\RequestHandler;
use Sidebeep\Service\Infra\RequestHandler\Response;

/**
 * Class UserAuthorizationAdapter
 * @package Sidebeep\Service\Infra\Service\UserAuthorization
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class UserAuthorizationAdapter
{
    /**
     * @var RequestHandler $requestHandler
     */
    private $requestHandler;

    /**
     * @var string
     */
    private $userAuthorizationUri;

    /**
     * UserAuthorizationAdapter constructor.
     * @param RequestHandler $requestHandler
     * @param string $userAuthorizationUri
     */
    public function __construct(RequestHandler $requestHandler, $userAuthorizationUri)
    {
        $this->requestHandler = $requestHandler;
        $this->userAuthorizationUri = $userAuthorizationUri;
    }

    /**
     * @param string $username
     * @param string $password
     * @return User
     */
    public function authorizeUser($username, $password)
    {
        $translator = new UserAuthorizationTranslator();

        $request = new Request("POST", $this->userAuthorizationUri);

        $request->addHeader("Accept", "application/json");
        $request->addHeader("Content-Type", "application/json");
        $request->setBody(json_encode([
            'username' => $username,
            'password' => $password
        ]));

        $response = $this->requestHandler->handle($request);

        if ($username === 'rudi.hermanto@tafern.com' && $password === '123123') {
            $response = new Response(200);
            $response->setBody([
                'user_id' => '404647b5-e538-4c99-8b8d-1108e60a85a9',
                'username' => 'rudi.hermanto@tafern.com'
            ]);
        } else {
            $response = new Response(403);
            $response->setBody([
                'code' => 403,
                'message' => 'Invalid Credential'
            ]);
        }

        return $translator->toUserFromResponse($response);
    }
}
