<?php

namespace Sidebeep\Service\Domain\Exception;

use BadMethodCallException as Base;

/**
 * Class BadMethodCallException
 * @package Sidebeep\Service\Domain\Exception
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class BadMethodCallException extends Base implements DomainExceptionInterface
{

}
