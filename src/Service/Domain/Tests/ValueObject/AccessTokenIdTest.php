<?php

namespace Sidebeep\Service\Domain\Tests\ValueObject;

use Sidebeep\Service\Domain\Exception\InvalidArgumentException;
use Sidebeep\Service\Domain\ValueObject\AccessTokenId;

/**
 * Class AccessTokenIdTest
 * @package Sidebeep\Service\Domain\Tests\ValueObject
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class AccessTokenIdTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFromString()
    {
        $UUIDString = '0f9c5b6e-ebd0-417c-8442-2015b60a50f2';
        $id = AccessTokenId::from($UUIDString);

        $this->assertTrue($id instanceof AccessTokenId);
        $this->assertTrue((string) $id === $UUIDString);
    }

    public function testCreateFromInvalidUUIDString()
    {
        $this->expectException(InvalidArgumentException::class);
        $UUIDString = 'InvalidString';
        AccessTokenId::from($UUIDString);
    }

    public function testCompareValueObject()
    {
        $UUIDString = '0f9c5b6e-ebd0-417c-8442-2015b60a50f2';
        $UUIDString2 = '0f9c5b6e-ebd0-417c-8442-2015b60a50f3';
        $id = AccessTokenId::from($UUIDString);
        $id2 = AccessTokenId::from($UUIDString);
        $id3 = AccessTokenId::from($UUIDString2);

        $this->assertTrue($id->compareWith($id2));
        $this->assertFalse($id->compareWith($id3));
    }
}
