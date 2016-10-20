<?php

namespace Sidebeep\Service\Infra\Service\UserAuthorization;

use Sidebeep\Service\Domain\Model\User;
use Sidebeep\Service\Domain\ValueObject\UserId;
use Sidebeep\Service\Infra\Exception\UnableToProcessResponseFromService;
use Sidebeep\Service\Infra\RequestHandler\Response;

/**
 * Class UserAuthorizationTranslator
 * @package Sidebeep\Service\Infra\Service\UserAuthorization
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class UserAuthorizationTranslator
{
    /**
     * @param Response $response
     * @return User
     * @throws UnableToProcessResponseFromService
     */
    public function toUserFromResponse(Response $response)
    {
        // User has been authenticated
        if (200 === $response->getStatusCode()) {
            $responseBodyArray = $this->validateAndGetResponseBodyArray($response);

            $userId = UserId::from($responseBodyArray['user_id']);
            return new User($userId, $responseBodyArray['username']);
        }

        // User is not valid
        if (403 === $response->getStatusCode()) {
            return null;
        }

        throw new UnableToProcessResponseFromService(
            $response,
            "Unable to process response body from user authorization"
        );
    }

    /**
     * @param Response $response
     * @return string
     * @throws UnableToProcessResponseFromService
     */
    private function validateAndGetResponseBodyArray(Response $response)
    {
        $contentArray = $response->getBody();

        if (isset($contentArray['user_id']) && isset($contentArray['username'])) {
            return $contentArray;
        }

        throw new UnableToProcessResponseFromService(
            $response,
            "Unable to process response body from user authorization"
        );
    }
}
