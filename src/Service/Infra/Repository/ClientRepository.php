<?php

namespace Sidebeep\Service\Infra\Repository;

use Doctrine\ORM\EntityRepository;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Repositories\ClientRepositoryInterface;
use Sidebeep\Service\Domain\Model\Client;
use Sidebeep\Service\Domain\Repository\ClientRepository as DomainClientRepository;
use Sidebeep\Service\Domain\ValueObject\ClientId;
use Sidebeep\Service\Domain\ValueObject\GrantType;

/**
 * Class ClientRepository
 * @package Sidebeep\Service\Infra\Repository
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ClientRepository extends EntityRepository implements DomainClientRepository, ClientRepositoryInterface
{

    /**
     * @param ClientId $id
     * @return Client
     */
    public function ofId(ClientId $id)
    {
        return $this->find($id);
    }

    /**
     * @param string $clientName
     * @return Client
     */
    public function ofName($clientName)
    {
        return $this->findOneBy(['name' => $clientName]);
    }

    /**
     * @param Client $client
     */
    public function add(Client $client)
    {
        $this->_em->persist($client);
        $this->_em->flush();
    }

    /**
     * @param Client $client
     */
    public function update(Client $client)
    {
        $this->add($client);
    }

    /**
     * @param Client $client
     */
    public function remove(Client $client)
    {
        $this->_em->remove($client);
        $this->_em->flush();
    }

    /**
     * Get a client.
     *
     * @param string $clientIdentifier The client's identifier
     * @param string $grantType The grant type used
     * @param null|string $clientSecret The client's secret (if sent)
     * @param bool $mustValidateSecret If true the client must attempt to validate the secret if the client
     *                                        is confidential
     *
     * @return ClientEntityInterface
     */
    public function getClientEntity($clientIdentifier, $grantType, $clientSecret = null, $mustValidateSecret = true)
    {
        $clientId = ClientId::from($clientIdentifier);
        $client = $this->ofId($clientId);

        if (is_null($client)) {
            return null;
        }

        if ($mustValidateSecret && !$client->validateSecret($clientSecret)) {
            return null;
        }

        $grantTypes = $client->getGrantType();
        $grantType = GrantType::from($grantType);
        if (!$grantTypes->contains($grantType)) {
            return null;
        }
        return $client;
    }
}
