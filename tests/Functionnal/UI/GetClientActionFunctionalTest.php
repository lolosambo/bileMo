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

use App\Domain\DataFixtures\ORM\ClientsFixtures;
use App\Domain\Models\Clients;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Blackfire\Profile\Configuration;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Tests\Traits\AuthenticationTestTrait;

/**
 * Class GetClientActionFunctionalTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetClientActionFunctionalTest extends WebTestCase
{
//    use TestCaseTrait;
    use AuthenticationTestTrait;

    private $repository;
    private $client;

    public function setup()
    {
        self::bootKernel();
        $this->repository = static::$kernel->getContainer()->get('doctrine')->getRepository(Clients::class);
        $em = static::$kernel->getContainer()->get('doctrine')->getManager();
        $clientsFixtures = new ClientsFixtures();
        $loader = new Loader();
        $loader->addFixture($clientsFixtures);
        $purger = new ORMPurger($em);
        $executor = new ORMExecutor(
            $em,
            $purger
        );
        $executor->execute($loader->getFixtures());
        $this->client = $this->repository->findOneByClientName('Client1');
    }

    /**
     * @group functional
     */
    public function testGetStatusCodeWithoutAuthentication()
    {
        $client = $this->authenticate(
            "BadUsername",
            "Badpassword"
        );
        $client->request(
            'GET',
            '/clients/'.$this->client->getId()->toString()
        );
        static::assertEquals(
            Response::HTTP_UNAUTHORIZED,
            $client->getResponse()->getStatusCode()
        );
    }

    /**
     * @group functional
     */
    public function testGetStatusCodeWithAuthentication()
    {
        $client = $this->authenticate(
            "Client1",
            "MySuperPassword"
        );
        $client->request(
            'GET',
            '/clients/'.$this->client->getId()->toString()
        );
        static::assertEquals(
            Response::HTTP_OK,
            $client->getResponse()->getStatusCode()
        );
        static::assertContains(
            'username',
            $client->getResponse()->getContent()
        );
        static::assertContains(
            'password',
            $client->getResponse()->getContent()
        );
        static::assertContains(
            'mail',
            $client->getResponse()->getContent()
        );
        static::assertContains(
            'inscription_date',
            $client->getResponse()->getContent()
        );
        static::assertContains(
            'links',
            $client->getResponse()->getContent()
        );
        static::assertContains(
            'self',
            $client->getResponse()->getContent()
        );
        static::assertContains(
            'href',
            $client->getResponse()->getContent()
        );
    }
}