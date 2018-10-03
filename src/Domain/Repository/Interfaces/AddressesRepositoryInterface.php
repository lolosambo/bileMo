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

use App\Domain\Models\Addresses;
use App\Domain\Models\Interfaces\AddressesInterface;

/**
 * Class AddressesRepositoryInterface.
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface AddressesRepositoryInterface
{
    /**
     * @param string $addressId
     *
     * @return Addresses
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findAddress(string $addressId): Addresses;

    /**
     * @return array
     */
    public function findAllAddresses(): array;

    /**
     * @param string $addressId
     * @return mixed
     */
    public function deleteAddress(string $addressId);

    /**
     * @param AddressesInterface $address
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($address);

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush();
}
