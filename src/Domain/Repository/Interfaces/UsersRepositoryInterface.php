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

use App\Domain\Models\Interfaces\UsersInterface;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class UsersRepositoryInterface.
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface UsersRepositoryInterface
{
    /**
     * @param string $userId
     *
     * @return mixed
     */
    public function findUser(string $userId);

    /**
     * @param string $username
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByUsername(string $username);

    /**
     * @param $mail
     *
     * @return mixed
     */
    public function findOneByMail($mail);

    /**
     * @return mixed
     */
    public function findAllUsers();

    /**
     * @return mixed
     */
    public function findAllUsersByClient(UuidInterface $clientId);

    /**
     * @param UsersInterface $userId
     * @return mixed
     */
    public function deleteUser(UsersInterface $userId);

    /**
     * @param $user
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($user);

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush();
}