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
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Blackfire\Profile\Configuration;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Tests\Traits\AuthenticationTestTrait;

/**
 * Class CreateUserActionFunctionalTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateUserActionFunctionalTest extends WebTestCase
{
//    use TestCaseTrait;
    use AuthenticationTestTrait;

    private $client;

    public function setup()
    {
        self::bootKernel();
        $this->client = self::createClient();
        $em = static::$kernel->getContainer()->get('doctrine')->getManager();
        $loader = new Loader();
        $purger = new ORMPurger($em);
        $executor = new ORMExecutor($em, $purger);
        $usersFixtures = new UsersFixtures();
        $loader->addFixture($usersFixtures);
        $executor->execute($loader->getFixtures());
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
            'POST',
            '/users',
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
            'POST',
            '/users',
            [],
            [],
            [
                "CONTENT_TYPE" => "application/json",
                'HTTP_Authorization' => "Bearer ".$token
            ],
            json_encode([
                "username" => "LolosamboTest",
                "password" => "MySuperPassword",
                "firstName" => "Laurent",
                "lastName" => "BERTON",
                "mail" => "lolosambo2@gmail.com",
                "address" => [
                    "number" => 20,
                    "way" => "allée Baudelaire",
                    "zipCode" => 59139,
                    "city" => "Wattignies",
                    "region" => "Nord",
                    "country" => "France"
                ],
                "phone" => "02.02.22.33.44"
            ])
        );
        static::assertEquals(
            Response::HTTP_CREATED,
            $this->client->getResponse()->getStatusCode()
        );
        static::assertContains(
            'L\'utilisateur a bien été ajouté à la base de données',
            $this->client->getResponse()->getContent()
        );
    }
}