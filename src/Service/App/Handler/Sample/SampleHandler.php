<?php
namespace Sidebeep\Service\App\Handler\Sample;

use Sidebeep\Service\App\Command\AppCommandInterface;
use Sidebeep\Service\App\Handler\Handler;

/**
 * @package Sidebeep\Service\App\Handler\Sample
 * @author  Irvan Setiawan <irvan.setiawan@tafern.com>
 */
class SampleHandler extends Handler
{
    /**
     * @param AppCommandInterface $command
     *
     * @return mixed
     */
    public function handle(AppCommandInterface $command)
    {
        // TODO: Implement handle() method.
    }
}