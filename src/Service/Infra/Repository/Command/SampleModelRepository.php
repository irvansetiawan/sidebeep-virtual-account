<?php
namespace Sidebeep\Service\Infra\Repository\Command;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Sidebeep\Service\Domain\Repository\SampleModelRepositoryInterface;

/**
 * @package Sidebeep\Service\Infra\Repository\Command
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
class SampleModelRepository extends DocumentRepository implements SampleModelRepositoryInterface
{
    /**
     * @param $id
     *
     * @return mixed
     * @throws \Doctrine\ODM\MongoDB\LockException
     */
    public function ofId($id)
    {
        return $this->find($id);
    }

    /**
     * @param $entity
     *
     * @return mixed
     */
    public function persistEntity($entity)
    {
        $this->dm->persist($entity);
        $this->dm->flush();
    }
}