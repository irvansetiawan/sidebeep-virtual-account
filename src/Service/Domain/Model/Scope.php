<?php

namespace Sidebeep\Service\Domain\Model;

use League\OAuth2\Server\Entities\ScopeEntityInterface;
use Sidebeep\Service\Domain\ValueObject\ScopeId;

/**
 * Scope Entity
 * @package Sidebeep\Service\Domain\Model
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class Scope implements ScopeEntityInterface
{

    /**
     * @var ScopeId
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * Scope constructor.
     * @param ScopeId $id
     * @param string $description
     */
    public function __construct(ScopeId $id, $description)
    {
        $this->id = $id;
        $this->description = $description;
    }

    /**
     * @param $id
     * @param $description
     * @return static
     */
    public static function create($id, $description)
    {
        return new static($id, $description);
    }

    /**
     * Get the scope's identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getIdentifier(),
            'description' => $this->description
        ];
    }
}
