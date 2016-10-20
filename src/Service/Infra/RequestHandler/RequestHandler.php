<?php

namespace Sidebeep\Service\Infra\RequestHandler;

/**
 * Interface RequestHandler
 * @package Sidebeep\Service\Infra\RequestHandler
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
interface RequestHandler
{
    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request);
}
