<?php
namespace Sidebeep\Service\App\Handler;

use Sidebeep\Service\App\Command\AppCommandInterface;

/**
 * Interface HandlerInterface
 * @package Sidebeep\Service\App\Handler
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
interface HandlerInterface
{
    /**
     * @param AppCommandInterface $command
     *
     * @return mixed
     */
    public function handle(AppCommandInterface $command);
}