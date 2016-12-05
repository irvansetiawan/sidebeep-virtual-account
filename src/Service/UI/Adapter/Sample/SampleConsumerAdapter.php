<?php
namespace Sidebeep\Service\UI\Adapter\Sample;

/**
 * @package Sidebeep\Service\UI\Adapter\Sample
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
class SampleConsumerAdapter
{
    public function getCommand($data)
    {
        if (!isset($data['user'])) {
            throw new InvalidMessageException();
        }

        $data = $data['user'];

        if (!isset($data['id'])) {
            throw new InvalidMessageException();
        }

        if (!isset($data['first_name'])) {
            throw new InvalidMessageException();
        }

        if (!isset($data['last_name'])) {
            throw new InvalidMessageException();
        }

        return new UserInfoUpdatedCommand(
            UserId::from($data['id']),
            FirstName::from($data['first_name']),
            LastName::from($data['last_name'])
        );
    }
}