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

namespace Tests\Domain\Models;

use App\Domain\Models\Addresses;
use App\Domain\Models\Clients;
use App\Domain\Models\Interfaces\AddressesInterface;
use App\Domain\Models\Interfaces\ClientsInterface;
use App\Domain\Models\Users;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

/**
 * Class UsersTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class UsersTest extends TestCase
{

    private $user;

    public function setUp()
    {
        $user = new Users(
            "TestUser",
            "MySuperPassword",
            'NameTest',
            'SurNameTest',
            "testuser@testprovider.com"
        );
        $user->setPhone('06 06 06 06 06');
        $this->user = $user;
    }

    /**
     * @group unit
     */
    public function testUsersConstruct()
    {
        static::assertInstanceof(Users::class, $this->user);
    }

    /**
     * @group unit
     */
    public function testUsersAttributes()
    {
        static::assertObjectHasAttribute('id', $this->user);
        static::assertObjectHasAttribute('username', $this->user);
        static::assertObjectHasAttribute('password', $this->user);
        static::assertObjectHasAttribute('firstName', $this->user);
        static::assertObjectHasAttribute('lastName', $this->user);
        static::assertObjectHasAttribute('phone', $this->user);
        static::assertObjectHasAttribute('mail', $this->user);
        static::assertObjectHasAttribute('inscriptionDate', $this->user);
        static::assertObjectHasAttribute('client', $this->user);
        static::assertObjectHasAttribute('address', $this->user);
    }

    /**
     * @group unit
     */
    public function testUsersMustHaveValidAttributes()
    {
        $client= $this->createMock(Clients::class);
        $this->user->setClient($client);
        $address= $this->createMock(Addresses::class);
        $this->user->setAddress($address);
        static::assertInstanceOf(UuidInterface::class, $this->user->getId());
        static::assertInternalType('string', $this->user->getUsername());
        static::assertInternalType('string', $this->user->getSalt());
        static::assertInternalType('string', $this->user->getFirstName());
        static::assertInternalType('string', $this->user->getLastName());
        static::assertInternalType('string', $this->user->getPhone());
        static::assertInternalType('string', $this->user->getMail());
        static::assertInstanceOf(\DateTimeImmutable::class, $this->user->getInscriptionDate());
        static::assertInstanceOf(ClientsInterface::class, $this->user->getClient());
        static::assertInstanceOf(AddressesInterface::class, $this->user->getAddress());
    }

    /**
     * @group unit
     */
    public function testPasswordMustBeCrypted()
    {
        static::assertContains('MySuperPassword', $this->user->getSalt());
    }

    /**
     * @group unit
     */
    public function testEmailAddressMustMatchWithPattern()
    {
        static::assertTrue($this->user->setMail('test@gmail.com'));
    }

    /**
     * @group unit
     */
    public function testEmailAddressMustReturnNullWithBadPattern()
    {
        static::assertFalse($this->user->setMail('tes/t@gmail.com51'));
    }
}






