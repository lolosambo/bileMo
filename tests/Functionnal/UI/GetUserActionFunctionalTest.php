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
namespace Tests\UI\Actions;

use App\Domain\DataFixtures\ORM\UsersFixtures;
use App\Domain\Models\Users;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Blackfire\Profile\Configuration;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Tests\Traits\AuthenticationTestTrait;

/**
 * Class GetUserActionFunctionalTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetUserActionFunctionalTest extends WebTestCase
{
//    use TestCaseTrait;
    use AuthenticationTestTrait;

    private $repository;
    private $user;
    private $client;

    public function setup()
    {
        self::bootKernel();
        $this->client = self::createClient();
        $this->repository = static::$kernel->getContainer()->get('doctrine')->getRepository(Users::class);
        $em = static::$kernel->getContainer()->get('doctrine')->getManager();
        $usersFixtures = new UsersFixtures();
        $loader = new Loader();
        $loader->addFixture($usersFixtures);
        $purger = new ORMPurger($em);
        $executor = new ORMExecutor(
            $em,
            $purger
        );
        $executor->execute($loader->getFixtures());
        $this->user = $this->repository->findOneByUsername('User1');
    }

    /**
     * @group functional
     */
    public function testGetStatusCodeWithoutAuthentication()
    {
        $token =  $this->authenticate(
            "BadUsername",
            "Badpassword"
        );
        $this->client->request(
            'GET',
            '/users/'.$this->user->getId()->toString(),
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_Authorization' => "Bearer ".$token
            ]
        );
        static::assertEquals(
            Response::HTTP_UNAUTHORIZED,
            $this->client->getResponse()->getStatusCode()
        );
    }

    /**
     * @group functional
     */
    public function testGetStatusCodeWithAuthentication()
    {
        $token =  $this->authenticate(
            "Client1",
            "MySuperPassword"
        );
        $this->client->request(
            'GET',
            '/users/'.$this->user->getId()->toString(),
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_Authorization' => "Bearer ".$token
            ]
        );
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode());
        static::assertContains(
            'username',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'password',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'firstName',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'lastName',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'mail',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'phone',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'inscriptionDate',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'address',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'way',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'zipCode',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'city',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'region',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'country',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'links',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'self',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'href',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'delete',
            $this->client->getResponse()->getContent()
        );
    }
}