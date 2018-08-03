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

use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Models\Users;
use App\Domain\Repository\Interfaces\UsersRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class UsersRepository.
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class UsersRepository extends ServiceEntityRepository implements UsersRepositoryInterface
{
    /**
     * UsersRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Users::class);
    }

    /**
     * @param string $userId
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findUser(string $userId)
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.address', 'ua')
            ->where('u.id = ?1')
            ->setParameter(1, $userId)
            ->setCacheable(true)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $username
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByUsername(string $username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.username = :username')
            ->setParameter('username', $username)
            ->setCacheable(true)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $mail
     *
     * @return mixed
     */
    public function findOneByMail(string $mail)
    {
        return $this->createQueryBuilder('u')
            ->Where('u.mail = :mail')
            ->setParameter('mail', $mail)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed
     */
    public function findAllUsers()
    {
        return $this->createQueryBuilder('u')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed
     */
    public function findAllUsersByClient(string $clientId)
    {
        return $this->createQueryBuilder('u')
            ->leftJoin('u.client', 'uc')
            ->where('uc.id = ?1')
            ->setParameter(1, $clientId)
            ->orderBy('u.username')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $userId
     *
     * @return mixed
     */
    public function deleteUser(string $userId)
    {
        return $this->createQueryBuilder('u')
            ->delete()
            ->where('u.id = ?1')
            ->setParameter(1, $userId)
            ->getQuery()
            ->execute();
    }

    /**
     * @param $user
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($user)
    {
        $this->getEntityManager()->persist($user);
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
