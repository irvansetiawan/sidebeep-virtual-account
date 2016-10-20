<?php

namespace Sidebeep\Service\Domain\Repository;

use Sidebeep\Service\Domain\Model\Client;
use Sidebeep\Service\Domain\ValueObject\ClientId;

/**
 * Interface ClientRepository
 * @package Sidebeep\Auth\Infra\OAuth2\Entity
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
interface ClientRepository
{
    /**
     * @param ClientId $id
     * @return Client
     */
    public function ofId(ClientId $id);

    /**
     * @param string $clientName
     * @return Client
     */
    public function ofName($clientName);

    /**
     * @param Client $client
     */
    public function add(Client $client);

    /**
     * @param Client $client
     */
    public function update(Client $client);

    /**
     * @param Client $client
     */
    public function remove(Client $client);
}