<?php
namespace Sidebeep\Service\Domain\Repository;

/**
 * Interface SampleModelRepositoryInterface
 * @package Sidebeep\Service\Domain\Repository
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
interface SampleModelRepositoryInterface
{
    /**
     * @return mixed
     */
    public function ofId($id);

    /**
     * @return mixed
     */
    public function persistEntity($entity);
}