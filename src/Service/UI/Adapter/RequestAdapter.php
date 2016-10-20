<?php

namespace Sidebeep\Service\UI\Adapter;

use Sidebeep\Service\App\Command\Command;
use Sidebeep\Service\UI\Request\Request;

/**
 * Interface Adapter
 * @package Sidebeep\Service\UI\Adapter
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
interface RequestAdapter
{
    /**
     * @param Request $request
     * @return Command
     */
    public function createCommandFromRequest(Request $request);
}
