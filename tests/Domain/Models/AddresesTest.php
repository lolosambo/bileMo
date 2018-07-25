<?php

declare(strict_types=1);

/*
 * This file is part of the Under The Roof project.
 *
 * (c) Laurent BERTON <lolosambo2@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\Domain\Models;

use App\Domain\Models\Addreses;
use App\Domain\Models\Interfaces\UsersInterface;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

/**
 * Class AddresesTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class AddresesTest extends TestCase
{
    private $address;

    public function setUp()
    {
        $address = new Addreses(
            5,
            'TestStreet',
            59000,
            'lille',
            'nord',
            'france'
        );
        $this->address = $address;
    }

    /**
     * @group unit
     */
    public function testAddresesConstruct()
    {
        static::assertInstanceof(Addreses::class, $this->address);
    }

    /**
     * @group unit
     */
    public function testAddresesAttributes()
    {
        static::assertObjectHasAttribute('id', $this->address);
        static::assertObjectHasAttribute('number', $this->address);
        static::assertObjectHasAttribute('way', $this->address);
        static::assertObjectHasAttribute('zipCode', $this->address);
        static::assertObjectHasAttribute('city', $this->address);
        static::assertObjectHasAttribute('region', $this->address);
        static::assertObjectHasAttribute('country', $this->address);
        static::assertObjectHasAttribute('user', $this->address);
    }

    /**
     * @group unit
     */
    public function testAddresesMustHaveValidAttributes()
    {
        $address= $this->createMock(Addreses::class);
        static::assertInstanceOf(UuidInterface::class, $address->getId());
        static::assertInternalType('integer', $this->address->getNumber());
        static::assertInternalType('string', $this->address->getWay());
        static::assertInternalType('integer', $this->address->getZipCode());
        static::assertInternalType('string', $this->address->getCity());
        static::assertInternalType('string', $this->address->getRegion());
        static::assertInternalType('string', $this->address->getCountry());
        static::assertInstanceOf(UsersInterface::class, $address->getUser());
    }

    /**
     * @group unit
     */
    public function testCaseForElementsName()
    {
        static::assertContains('Lille', $this->address->getCity());
        static::assertContains('Nord', $this->address->getRegion());
        static::assertContains('FRANCE', $this->address->getCountry());
    }
}





