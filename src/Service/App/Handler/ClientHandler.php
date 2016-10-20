<?php

namespace Sidebeep\Service\App\Handler;

use Sidebeep\Service\App\Command\Client\AddGrantTypeCommand;
use Sidebeep\Service\App\Command\Client\AddScopeCommand;
use Sidebeep\Service\App\Command\Client\ClientCommand;
use Sidebeep\Service\App\Command\Client\DeleteCommand;
use Sidebeep\Service\App\Command\Client\RemoveGrantTypeCommand;
use Sidebeep\Service\App\Command\Client\RemoveScopeCommand;
use Sidebeep\Service\Domain\Model\Client;
use Sidebeep\Service\Domain\Repository\ClientRepository;

/**
 * Class ClientHandler
 * @package Sidebeep\Service\App\Handler
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ClientHandler implements ClientHandlerInterface
{
    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * ClientHandler constructor.
     * @param ClientRepository $clientRepository
     */
    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    /**
     * @param ClientCommand $command
     * @return Client
     */
    public function add(ClientCommand $command)
    {
        $client = Client::create(
            $command->clientId,
            $command->name,
            $command->redirectUri,
            $command->secret
        );

        $this->clientRepository->add($client);
        return $client;
    }

    /**
     * @param DeleteCommand $command
     * @return bool
     */
    public function delete(DeleteCommand $command)
    {
        $client = $this->clientRepository->ofId($command->clientId);
        if ($client) {
            $this->clientRepository->remove($client);
            return true;
        }
        return false;
    }

    /**
     * @param AddScopeCommand $command
     * @return Client
     */
    public function addScope(AddScopeCommand $command)
    {
        $client = $this->clientRepository->ofId($command->clientId);
        if ($client) {
            $client->addScope($command->scope);
            $this->clientRepository->update($client);
            return $client;
        }
        return null;
    }

    /**
     * @param RemoveScopeCommand $command
     * @return Client
     */
    public function removeScope(RemoveScopeCommand $command)
    {
        $client = $this->clientRepository->ofId($command->clientId);
        if ($client) {
            $client->removeScope($command->scope);
            $this->clientRepository->update($client);
            return $client;
        }
        return null;
    }

    /**
     * @param AddGrantTypeCommand $command
     * @return Client
     */
    public function addGrantType(AddGrantTypeCommand $command)
    {
        $client = $this->clientRepository->ofId($command->clientId);
        if ($client) {
            $client->addGrantType($command->grantType);
            $this->clientRepository->update($client);
            return $client;
        }
        return null;
    }

    /**
     * @param removeGrantTypeCommand $command
     * @return Client
     */
    public function removeGrantType(removeGrantTypeCommand $command)
    {
        $client = $this->clientRepository->ofId($command->clientId);
        if ($client) {
            $client->removeGrantType($command->grantType);
            $this->clientRepository->update($client);
            return $client;
        }
        return null;
    }
}
