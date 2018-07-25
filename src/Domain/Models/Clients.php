<?php

declare(strict_types=1);

/*
 * This file is part of the Under The Roof project.
 *
 * (c) Laurent BERTON <lolosambo2@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\ClientsInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;


/**
 * Class Clients
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class Clients implements ClientsInterface
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var array
     */
    private $roles = [];

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $mail;

    /**
     * @var \DateTime
     */
    private $inscriptionDate;
    /**
     * @var ArrayCollection
     */
    private $users;

    /**
     * Clients constructor.
     * @param string $username
     * @param string $password
     * @param string $mail
     * @throws \Exception
     */
    public function __construct(
        string $username,
        string $password,
        string $mail
    ) {
        $this->id = Uuid::uuid4();
        $this->username = $username;
        $this->roles[] = 'ROLE_USER';
        $this->password = $password;
        $this->mail = $mail;
        $this->users = new ArrayCollection();
        $this->inscriptionDate = new \DateTime('NOW');
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }
    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param $mail
     *
     * @return bool
     */
    public function setMail($mail)
    {
        if (preg_match('#^([0-9a-zA-Z-_]+)@([0-9a-zA-Z-_]+).([a-z]+)$#', $mail)) {
            $this->mail = $mail;
            return true;
        }
        return false;
    }

    /**
     * @return \DateTime
     */
    public function getInscriptionDate(): \DateTime
    {
        return $this->inscriptionDate;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers(): ArrayCollection
    {
        return $this->users;
    }

    /**
     * @param Users $user
     */
    public function addUser(Users $user)
    {
        $this->users[] = $user;
        $user->setClient($this);
    }
    /**
     * @param Users $user
     */
    public function removeUser(Users $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * @return bool|string
     */
    public function getSalt()
    {
        return $this->password;
    }

    /**
     * @return bool
     */
    public function eraseCredentials()
    {
        return false;
    }
    /**
     * @return string
     */
    public function serialize()
    {
        return serialize(
            [
                $this->id,
                $this->username,
                $this->password,
                $this->mail
            ]
        );
    }
    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->mail
            ) = unserialize(
            $serialized,
            ['allowed_classes' => false]
        );
    }
}

