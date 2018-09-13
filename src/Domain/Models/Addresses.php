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
use App\Domain\Models\Users;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Addresses
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class Addresses implements AddressesInterface, \JsonSerializable
{
    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var int $number
     *
     * @Groups ({"user"})
     */
    private $number;

    /**
     * @var string $way
     *
     * @Groups ({"user"})
     */
    private $way;

    /**
     * @var int $zipCode
     *
     * @Groups ({"user"})
     */
    private $zipCode;

    /**
     * @var string $city
     *
     * @Groups ({"user"})
     */
    private $city;

    /**
     * @var string $region
     *
     * @Groups ({"user"})
     */
    private $region;

    /**
     * @var string $country
     *
     * @Groups ({"user"})
     */
    private $country;

    /**
     * @var array $users
     */
    private $users;

    /**
     * Addresses constructor.
     *
     * @param int $number
     * @param string $way
     * @param int $zipCode
     * @param string $city
     * @param string $region
     * @param string $country
     *
     * @throws \Exception
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
        $this->city = $city;
        $this->region = $region;
        $this->country = $country;
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

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->number,
            $this->way,
            $this->zipCode,
            $this->city,
            $this->region,
            $this->country
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->number,
            $this->way,
            $this->zipCode,
            $this->city,
            $this->region,
            $this->country
            ) = unserialize($serialized);
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
        $user->setAddress($this);
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

    public function jsonSerialize()
    {
        return [
            'number' => $this->number,
            'way' => $this->way,
            'zipCode' => $this->zipCode,
            'city' =>$this->city,
            'region' => $this->region,
            'country' => $this->country
        ];
    }
}



