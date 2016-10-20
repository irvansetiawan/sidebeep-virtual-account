<?php

namespace Sidebeep\Service\Domain\Exception;

use InvalidArgumentException as Base;

/**
 * Exception thrown if argument is not of the expected type.
 * @package Sidebeep\Service\Domain\Exception
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class InvalidArgumentException extends Base implements DomainExceptionInterface
{

}
