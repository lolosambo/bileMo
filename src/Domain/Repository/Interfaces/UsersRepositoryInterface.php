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

use App\Domain\Models\Users;

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
     * @return Users
     */
    public function findUser(string $userId);

    /**
     * @param string $username
     *
     * @return Users
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByUsername(string $username): Users;

    /**
     * @return array
     */
    public function findAllUsers(): array;

    /**
     * @return array
     */
    public function findAllUsersByClient(string $clientId): array;

    /**
     * @param string $userId
     *
     * @return mixed
     */
    public function deleteUser(string $userId);

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