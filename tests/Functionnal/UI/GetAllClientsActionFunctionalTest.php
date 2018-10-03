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
use Blackfire\Profile\Configuration;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Tests\Traits\AuthenticationTestTrait;

/**
 * Class GetAllClientsActionFunctionalTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllClientsActionFunctionalTest extends WebTestCase
{
//    use TestCaseTrait;
    use AuthenticationTestTrait;

    private $client;

    public function setup()
    {
        self::bootKernel();
        $this->client = self::createClient();
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
    }

    /**
     * @group functional
     */
    public function testGetStatusCodeWithoutAuthentication()
    {
        $token =  $this->authenticate(
            "Client12351555",
            "MySuperBadPassword"
        );
        $this->client->request(
            'GET',
            '/clients',
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
     *
     * @throws \Exception
     */
    public function testGetStatusCodeWithAuthentication()
    {
        $token =  $this->authenticate(
            "Client1",
            "MySuperPassword"
        );
        $this->client->request(
            'GET',
            '/clients',
            [],
            [],
            [
                "CONTENT_TYPE" => "application/json",
                "HTTP_Authorization" => "Bearer ".$token
            ]
        );
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
        static::assertContains(
            'username',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'password',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'mail',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'inscription_date',
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
    }
}