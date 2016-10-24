<?php

namespace Sidebeep\Service\Infra\Service\SyncServiceInteractionSample;

use Sidebeep\Service\Domain\Model\Sample;
use Sidebeep\Service\Domain\ValueObject\SampleId;
use SidebeepService\RequestHandler\Response;
use SidebeepService\RequestHandler\UnableToProcessResponseFromService;

class SyncServiceInteractionSampleTranslator
{
    /**
     * @param Response $response
     * @return Sample
     * @throws UnableToProcessResponseFromService
     */
    public function toUserFromResponse(Response $response)
    {
        // User has been authenticated
        if (200 === $response->getStatusCode()) {
            $responseBodyArray = $this->validateAndGetResponseBodyArray($response);

            $sampleId = SampleId::from($responseBodyArray['sample_id']);
            return Sample::create($sampleId, $responseBodyArray['name']);
        }

        // User is not valid
        if (403 === $response->getStatusCode()) {
            return null;
        }

        throw new UnableToProcessResponseFromService(
            $response,
            "Unable to process response body from sample service"
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

        if (isset($contentArray['sample_id']) && isset($contentArray['name'])) {
            return $contentArray;
        }

        throw new UnableToProcessResponseFromService(
            $response,
            "Unable to process response body from sample service"
        );
    }
}
