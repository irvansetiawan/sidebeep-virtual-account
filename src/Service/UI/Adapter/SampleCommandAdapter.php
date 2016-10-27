<?php

namespace Sidebeep\Service\UI\Adapter;

use Sidebeep\Service\App\Command\SampleCommand;
use SidebeepService\RequestAdapter\Request;
use SidebeepService\RequestAdapter\RequestAdapter;

/**
 * Class TokenCommandAdapter
 * @package Sidebeep\Service\UI\Adapter
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class SampleCommandAdapter implements RequestAdapter
{

    /**
     * @param Request $request
     * @return SampleCommand
     */
    public function createCommandFromRequest(Request $request)
    {
        $parameters = $request->getRequestParameters();

        $command = new SampleCommand(
            $parameters['prop_1'],
            $parameters['prop_2']
        );

        return $command;
    }
}
