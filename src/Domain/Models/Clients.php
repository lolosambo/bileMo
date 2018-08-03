<?php

declare(strict_types=1);

/*
 * This file is part of the bileMo project.
 *
 * (c) Laurent BERTON <lolosambo2@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\ClientsInterface;
use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Clients
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class Clients implements ClientsInterface
{
    /**
     * @var UuidInterface
     *
     * @Groups({"clients", "client"})
     */
    private $id;

    /**
     * @var string
     *
     * @Groups({"clients", "client"})
     */
    private $username;

    /**
     * @var array
     */
    private $roles = [];

    /**
     * @var string
     *
     * @Groups({"client"})
     */
    private $password;

    /**
     * @var string
     *
     * @Groups({"client"})
     */
    private $mail;

    /**
     * @var \DateTimeImmutable
     *
     * @Groups({"client"})
     */
    private $inscriptionDate;

    /**
     * @var array
     *
     * @Groups({"usersPerClients"})
     */
    private $users;

    /**
     * Clients constructor.
     *
     * @param string $username
     * @param string $password
     * @param string $mail
     *
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
        $this->users = [];
        $this->inscriptionDate = new \DateTime();
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
     * @return \DateTimeImmutable
     */
    public function getInscriptionDate(): \DateTimeImmutable
    {
        $date = DateTimeImmutable::createFromMutable($this->inscriptionDate );
        return $date;
    }

    /**
     * @param \DateTime $date
     */
    public function setInscriptionDate(\DateTime $date)
    {
        $inscriptionDate = DateTimeImmutable::createFromMutable($date );
        $this->inscriptionDate = $inscriptionDate;
    }

    /**
     * @return array
     */
    public function getUsers()
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
        $index = array_search($user, $this->getUsers());
        if($index !== false){
            unset($this->getUsers()[$index]);
        }
    }

    /**
     * @return bool|string
     */
    public function getSalt()
    {
        return $this->password;
    }

    /**
     * @return bool|string
     */
    public function getPassword()
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

