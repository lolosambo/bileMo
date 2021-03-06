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

use App\Domain\Models\Interfaces\ClientsInterface;
use App\Domain\Models\Clients;
use App\Domain\Models\Users;
use App\Domain\Repository\Interfaces\ClientsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Cache\ApcuCache;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ClientsRepository.
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class ClientsRepository extends ServiceEntityRepository implements ClientsRepositoryInterface
{
    /**
     * ClientsRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(
        RegistryInterface $registry
    ) {
        parent::__construct($registry, Clients::class);
    }

    /**
     * @param string $clientId
     *
     * @return Users
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findClient(string $clientId)
    {
        return $this->createQueryBuilder('c')
                ->where('c.id = ?1')
                ->setParameter(1, $clientId)
                ->setCacheable(true)
                ->getQuery()
                ->getOneOrNullResult();
    }

    /**
     * @param string $clientName
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByClientName(string $username)
    {
        return $this->createQueryBuilder('c')
                ->where('c.username = :username')
                ->setParameter('username', $username)
                ->setCacheable(true)
                ->getQuery()
                ->getOneOrNullResult();
    }

    /**
     * @return mixed
     */
    public function findAllClients()
    {
       return  $this->createQueryBuilder('c')
            ->setCacheable(true)
            ->getQuery()
            ->setCacheable(true)
            ->getResult();
    }

    /**
     * @param string $clientId
     * @return mixed
     */
    public function deleteClient(string $clientId)
    {
        return $this->createQueryBuilder('c')
            ->delete()
            ->where('c.id = ?1')
            ->setParameter(1, $clientId)
            ->setCacheable(true)
            ->getQuery()
            ->execute();
    }

    /**
     * @param $client
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($client)
    {
        $this->getEntityManager()->persist($client);
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