<?php

namespace Sidebeep\Service\UI\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Login
 * @package Sidebeep\Service\UI\Entity
 * @author Rudi Hermanto <rudi.hermanto@tafern.com>
 */
class Login
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The username '{{ value }}' is not a valid email."
     * )
     */
    protected $username;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    protected $password;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
