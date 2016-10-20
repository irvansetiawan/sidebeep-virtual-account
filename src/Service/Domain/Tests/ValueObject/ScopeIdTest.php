<?php

namespace Sidebeep\Service\Domain\Tests\ValueObject;

use Sidebeep\Service\Domain\Exception\InvalidArgumentException;
use Sidebeep\Service\Domain\ValueObject\ScopeId;

/**
 * Class ScopeIdTest
 * @package Sidebeep\Service\Domain\Tests\ValueObject
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class ScopeIdTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateFromString()
    {
        $scopeIdString = 'valid-_scope.id';
        $id = ScopeId::from($scopeIdString);

        $this->assertTrue($id instanceof ScopeId);
        $this->assertTrue((string) $id === $scopeIdString);
    }

    public function testCreateFromInvaliString()
    {
        $this->expectException(InvalidArgumentException::class);
        $scopeIdString = 'Valid String can\'t be longer than 128 characters ';
        $scopeIdString .= 'and must be only contains alphanumeric, comma, underscore, or dash';
        ScopeId::from($scopeIdString);
    }

    public function testCompareValueObject()
    {
        $scopeIdString = 'valid-_scope.id';
        $scopeIdString2 = 'valid-_scope.id2';
        $id = ScopeId::from($scopeIdString);
        $id2 = ScopeId::from($scopeIdString);
        $id3 = ScopeId::from($scopeIdString2);

        $this->assertTrue($id->compareWith($id2));
        $this->assertFalse($id->compareWith($id3));
    }
}
