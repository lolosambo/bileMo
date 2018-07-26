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
use Ramsey\Uuid\UuidInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


/**
 * Class UsersTest
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

    public function testFindUser(UuidInterface $userId)
    {
        $product = $this->repository->findUser();
        static::assertCount(1, $product);
    }


}





