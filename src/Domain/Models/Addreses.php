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

use App\Domain\Models\Interfaces\AddressesInterface;
use App\Domain\Models\Interfaces\UsersInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Addresses
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class Addresses implements AddressesInterface
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var int $number
     */
    private $number;

    /**
     * @var string $way
     */
    private $way;

    /**
     * @var int $zipCode
     */
    private $zipCode;

    /**
     * @var string $city
     */
    private $city;

    /**
     * @var string $region
     */
    private $region;

    /**
     * @var string $country
     */
    private $country;

    /**
     * @var UsersInterface  $user
     */
    private $user;

    /**
     * Addresses constructor.
     * @param int $number
     * @param string $way
     * @param int $zipCode
     * @param string $city
     * @param string $region
     * @param string $country
     */
    public function __construct(
        int $number,
        string $way,
        int $zipCode,
        string $city,
        string $region,
        string $country
    ) {
        $this->id = Uuid::uuid4();
        $this->number = $number;
        $this->way = $way;
        $this->zipCode = $zipCode;
        $this->city = ucfirst($city);
        $this->region = ucfirst($region);
        $this->country = strtoupper($country);
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getWay(): string
    {
        return $this->way;
    }

    /**
     * @param string $way
     */
    public function setWay(string $way): void
    {
        $this->way = $way;
    }

    /**
     * @return int
     */
    public function getZipCode(): int
    {
        return $this->zipCode;
    }

    /**
     * @param int $zipCode
     */
    public function setZipCode(int $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = ucfirst($city);
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region): void
    {
        $this->region = ucfirst($region);
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = strtoupper($country);
    }

    /**
     * @return UsersInterface
     */
    public function getUser(): UsersInterface
    {
        return $this->user;
    }

    /**
     * @param UsersInterface $user
     */
    public function setUser(UsersInterface $user)
    {
        $this->user = $user;
    }
}


