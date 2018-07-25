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

namespace App\Domain\Models\Interfaces;

use Ramsey\Uuid\UuidInterface;

/**
 * Interface UsersInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface UsersInterface
{
    /**
     * Users constructor.
     *
     * @param string  $pseudo
     * @param string  $password
     * @param string  $mail
     */
    public function __construct(
        string $username,
        string $password,
        string $firstName,
        string $lastName,
        string $mail
    );

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return null|string
     */
    public function getSalt();

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param string $phone
     */
    public function setPhone(string $phone);

    /**
     * @return AddresesInterface
     */
    public function getAddress();

    /**
     * @param AddresesInterface $address
     */
    public function setAddress(AddresesInterface $address);

    /**
     * @return string
     */
    public function getMail(): string;

    /**
     * @param $mail
     *
     * @return bool
     */
    public function setMail($mail);

    /**
     * @return \DateTime
     */
    public function getInscriptionDate(): \DateTime;

    /**
     * @return array
     */
    public function getRoles();

    /**
     * @return mixed
     */
    public function eraseCredentials();

    /** @see \Serializable::serialize() */
    public function serialize();

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized);

    /**
     * @return ClientsInterface
     */
    public function getClient();

    /**
     * @param ClientsInterface $client
     */
    public function setClient(ClientsInterface $client);

}


