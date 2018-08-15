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

namespace App\Domain\Repository;

use App\Domain\Models\Interfaces\AddressesInterface;
use App\Domain\Models\Addresses;
use App\Domain\Repository\Interfaces\AddressesRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class AddressesRepository.
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class AddressesRepository extends ServiceEntityRepository implements AddressesRepositoryInterface
{
    /**
     * AddressesRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Addresses::class);
    }

    /**
     * @param string $addressId
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findAddress(string $addressId)
    {
        return $this->createQueryBuilder('a')
            ->where('a.id = ?1')
            ->setParameter(1, $addressId)
            ->setCacheable(true)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $city
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByCity(string $city)
    {
        return $this->createQueryBuilder('a')
            ->where('a.city = :city')
            ->setParameter('city', $city)
            ->setCacheable(true)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @return mixed
     */
    public function findAllAddresses()
    {
        return $this->createQueryBuilder('a')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $addressId
     * @return mixed
     */
    public function deleteAddress(string $addressId)
    {
        return $this->createQueryBuilder('a')
            ->delete()
            ->where('a.id = ?1')
            ->setParameter(1, $addressId)
            ->getQuery()
            ->execute();
    }

    /**
     * @param AddressesInterface $address
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($address)
    {
        $this->getEntityManager()->persist($address);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}