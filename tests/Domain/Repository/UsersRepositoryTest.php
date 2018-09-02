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

namespace Tests\Domain\Repository;
use App\Domain\Models\Users;
use App\Domain\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class UsersRepositoryTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class UsersRepositoryTest extends KernelTestCase
{
    /**
     * @var UsersRepository $repository
     */
    private $repository;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();
        $this->em = $kernel->getContainer()
                           ->get('doctrine')
                           ->getManager();
        $this->repository = $this->em->getRepository(Users::class);

    }

    /**
     * @group functional
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function testFindUser()
    {
        $user = $this->repository->findUser('352e0c3f-cf98-4564-9e14-013724fde2a9');
        static::assertInstanceOf(Users::class, $user);
        static::assertContains("User1", $user->getUsername());
        static::assertContains("d67069e5c12507fbd2c11210a1d49d03e4a5d825", $user->getPassword());
        static::assertContains("emailforuser1@provider.com", $user->getMail());
        static::assertContains("FirstName1", $user->getFirstName());
        static::assertContains("LASTNAME1", $user->getLastName());
        static::assertContains("06 78 33 92 77", $user->getPhone());
    }

    /**
     * @group functional
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function testFindOneByUsername()
    {
        $user = $this->repository->findByUsername('user1');
        static::assertInternalType('array', $user);
    }

    /**
     * @group functional
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function testFindOneByMail()
    {
        $user = $this->repository->findByUsername('emailforuser1@provider.com');
        static::assertInternalType('array', $user);
    }

    /**
     * @group functional
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function testFindAllusers()
    {
        $user = $this->repository->findAllUsers();
        static::assertInternalType('array', $user);
    }


}





