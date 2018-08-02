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

namespace App\Domain\Models\Interfaces;

use App\Domain\Models\Users;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;
use Ramsey\Uuid\UuidInterface;

/**
 * Interface ClientsInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
interface ClientsInterface
{

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getUsername(): string;

    /**
     * @param string $username
     */
    public function setUsername(string $username);

    /**
     * @return array
     */
    public function getRoles(): array;

    /**
     * @return string
     */
    public function getMail();

    /**
     * @param $mail
     *
     * @return bool
     */
    public function setMail($mail);

    /**
     * @return \DateTimeImmutable
     */
    public function getInscriptionDate(): \DateTimeImmutable;

    /**
     * @param \DateTimeImmutable $date
     */
    public function setInscriptionDate(\DateTime $date);

    /**
     * @return array
     */
    public function getUsers();

    /**
     * @param Users $user
     */
    public function addUser(Users $user);

    /**
     * @param Users $user
     */
    public function removeUser(Users $user);

    /**
     * @return bool
     */
    public function getSalt();

    /**
     * @return bool|string
     */
    public function getPassword();

    /**
     * @return bool
     */
    public function eraseCredentials();

    /**
     * @return string
     */
    public function serialize();

    /**
     * @param string $serialized
     */
    public function unserialize($serialized);
}


