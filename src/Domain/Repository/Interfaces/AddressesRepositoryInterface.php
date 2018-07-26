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

namespace App\Domain\Repository\Interfaces;

use App\Domain\Models\Interfaces\AddressesInterface;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class AddressesRepositoryInterface.
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface AddressesRepositoryInterface
{
    /**
     * AddressesRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @param UuidInterface $addressId
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findAddress(UuidInterface $addressId);

    /**
     * @param string $city
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByCity(string $city);

    /**
     * @return mixed
     */
    public function findAllAddresses();

    /**
     * @param AddressesInterface $addressId
     * @return mixed
     */
    public function deleteAddress(AddressesInterface $addressId);

    /**
     * @param AddressesInterface $address
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(AddressesInterface $address);

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush();
}
