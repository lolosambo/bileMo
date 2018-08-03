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

use App\Domain\Models\Users;
use Ramsey\Uuid\UuidInterface;
use App\Domain\Models\Interfaces\UsersInterface;

/**
 * Interface AddressesInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface AddressesInterface
{
    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return int
     */
    public function getNumber(): int;

    /**
     * @param int $number
     */
    public function setNumber(int $number): void;

    /**
     * @return string
     */
    public function getWay(): string;

    /**
     * @param string $way
     */
    public function setWay(string $way): void;

    /**
     * @return int
     */
    public function getZipCode(): int;

    /**
     * @param int $zipCode
     */
    public function setZipCode(int $zipCode): void;

    /**
     * @return string
     */
    public function getCity(): string;

    /**
     * @param string $city
     */
    public function setCity(string $city): void;

    /**
     * @return string
     */
    public function getRegion(): string;

    /**
     * @param string $region
     */
    public function setRegion(string $region): void;

    /**
     * @return string
     */
    public function getCountry(): string;

    /**
     * @param string $country
     */
    public function setCountry(string $country): void;

    /** @see \Serializable::serialize() */
    public function serialize();

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized);

    /**
     * @param Users $user
     */
    public function addUser(Users $user);

    /**
     * @param Users $user
     */
    public function removeUser(Users $user);

}




