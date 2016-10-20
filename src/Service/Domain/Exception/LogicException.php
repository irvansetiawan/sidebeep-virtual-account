<?php

namespace Sidebeep\Service\Domain\Exception;

use LogicException as Base;

/**
 * Exception that represents error in the program logic.
 * This kind of exception should lead directly to a fix in your code.
 * @package Sidebeep\Service\Domain\Exception
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class LogicException extends Base implements DomainExceptionInterface
{

}
