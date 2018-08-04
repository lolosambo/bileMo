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

use App\Domain\Models\Clients;
use App\Domain\Models\Interfaces\ClientsInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ClientsRepositoryInterface.
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface ClientsRepositoryInterface
{
    /**
     * ClientsRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @param string $clientId
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findClient(string $clientId);

    /**
     * @param string $clientname
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByClientName(string $clientname);

    /**
     * @param $mail
     *
     * @return mixed
     */
    public function findOneByMail($mail);

    /**
     * @return mixed
     */
    public function findAllClients();

    /**
     * @param ClientsInterface $clientId
     * @return mixed
     */
    public function deleteClient(ClientsInterface $clientId);

    /**
     * @param $client
     *
     * @return mixed
     */
    public function save($client);

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush();
}