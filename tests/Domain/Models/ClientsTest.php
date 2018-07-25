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

use App\Domain\Models\Clients;
use App\Domain\Models\Users;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

/**
 * Class ClientsTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class ClientsTest extends TestCase
{
    private $client;

    public function setUp()
    {
        $client = new Clients(
            "TestClient",
            "MySuperPassword",
            "testuser@testprovider.com"
        );
        $this->client = $client;
    }

    /**
     * @group unit
     */
    public function testUsersConstruct()
    {
        static::assertInstanceof(Clients::class, $this->client);
    }

    /**
     * @group unit
     */
    public function testUsersAttributes()
    {
        static::assertObjectHasAttribute('id', $this->client);
        static::assertObjectHasAttribute('username', $this->client);
        static::assertObjectHasAttribute('password', $this->client);
        static::assertObjectHasAttribute('mail', $this->client);
        static::assertObjectHasAttribute('roles', $this->client);
        static::assertObjectHasAttribute('inscriptionDate', $this->client);
        static::assertObjectHasAttribute('users', $this->client);
    }

    /**
     * @group unit
     */
    public function testClientsMustHaveValidAttributes()
    {
        static::assertInstanceOf(UuidInterface::class, $this->client->getId());
        static::assertInternalType('string', $this->client->getUsername());
        static::assertInternalType('array', $this->client->getRoles());
        static::assertInternalType('string', $this->client->getSalt());
        static::assertInternalType('string', $this->client->getMail());
        static::assertInstanceOf(\DateTime::class, $this->client->getInscriptionDate());
        static::assertInstanceOf(ArrayCollection::class, $this->client->getUsers());
    }

    /**
     * @group unit
     */
    public function testAddFunctions()
    {
        $user = $this->createMock(Users::class);
        $this->client->addUser($user);
        static::assertInstanceOf(Users::class, $this->client->getUsers()->first());
    }

    /**
     * @group unit
     */
    public function testRemoveFunctions()
    {
        $user = $this->createMock(Users::class);
        $this->client->addUser($user);
        $this->client->removeUser($user);
        static::assertNull(null, $this->client->getUsers());
    }

    /**
     * @group unit
     */
    public function testPasswordMustBeCrypted()
    {
        static::assertContains('MySuperPassword', $this->client->getSalt());
    }

    /**
     * @group unit
     */
    public function testEmailAddressMustMatchWithPattern()
    {
        static::assertTrue($this->client->setMail('test@gmail.com'));
    }

    /**
     * @group unit
     */
    public function testEmailAddressMustReturnNullWithBadPattern()
    {
        static::assertFalse($this->client->setMail('tes/t@gmail.com51'));
    }
}






