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
use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Models\Interfaces\AddressesInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Users
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class Users implements UsersInterface
{
    /**
     * @var UuidInterface $id
     */
    private $id;

    /**
     * @var string  $username
     */
    private $username;

    /**
     * @var string $firstName
     */
    private $firstName;

    /**
     * @var string $lastName
     */
    private $lastName;

    /**
     * @var string $phone
     */
    private $phone;

    /**
     * @var ArrayCollection $address
     */
    private $address;

    /**
     * @var string $password
     */
    private $password;

    /**
     * @var string $mail
     */
    private $mail;

    /**
     * @var \DateTime $inscriptionDate
     */
    private $inscriptionDate;

    /**
     * @var ClientsInterface $client
     */
    private $client;

    /**
     * Users constructor.
     * @param string $username
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     * @param string $mail
     * @throws \Exception
     */
    public function __construct(
        string $username,
        string $password,
        string $firstName,
        string $lastName,
        string $mail
    ) {
        $this->id = Uuid::uuid4();
        $this->username = $username;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->mail = $mail;
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return null|string
     */
    public function getSalt()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return ArrayCollection
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param AddressesInterface $address
     */
    public function setAddress(AddressesInterface $address)
    {
        $this->address[] = $address;
    }

    /**
     * @return string
     */
    public function getMail(): string
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
     * @param \DateTime $date
     */
    public function setInscriptionDate(\DateTime $date)
    {
        $this->inscriptionDate = $date;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
            $this->firstName,
            $this->lastName,
            $this->phone,
            $this->mail
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password,
            $this->firstName,
            $this->lastName,
            $this->phone,
            $this->mail
            ) = unserialize($serialized);
    }

    /**
     * @return ClientsInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ClientsInterface $client
     */
    public function setClient(ClientsInterface $client)
    {
        $this->client = $client;
    }

}

