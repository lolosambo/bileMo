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

    private $request;

    private $client;

    public function setup()
    {
        self::bootKernel();
        $this->request = static::createClient();
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
        $token =  $this->authenticate(
            "BadUsername",
            "Badpassword"
        );
        $this->request->request(
            'GET',
            '/clients/'.$this->client->getId()->toString(),
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_Authorization' => "Bearer ".$token
            ]
        );

        static::assertEquals(
            Response::HTTP_UNAUTHORIZED,
            $this->request->getResponse()->getStatusCode()
        );
    }

    /**
     * @group functional
     *
     * @throws \Exception
     */
    public function testGetStatusCodeWithAuthentication()
    {
        $token =  $this->authenticate(
            "Client1",
            "MySuperPassword"
        );
        $this->request->request(
            'GET',
            '/clients/'.$this->client->getId()->toString(),
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_Authorization' => "Bearer ".$token
            ]
        );
        static::assertEquals(
            Response::HTTP_OK,
            $this->request->getResponse()->getStatusCode()
        );
        static::assertContains(
            'username',
            $this->request->getResponse()->getContent()
        );
        static::assertContains(
            'password',
            $this->request->getResponse()->getContent()
        );
        static::assertContains(
            'mail',
            $this->request->getResponse()->getContent()
        );
        static::assertContains(
            'inscription_date',
            $this->request->getResponse()->getContent()
        );
        static::assertContains(
            'links',
            $this->request->getResponse()->getContent()
        );
        static::assertContains(
            'self',
            $this->request->getResponse()->getContent()
        );
        static::assertContains(
            'href',
            $this->request->getResponse()->getContent()
        );
    }
}