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

use App\Domain\DataFixtures\ORM\AddressesFixtures;
use App\Domain\DataFixtures\ORM\ClientsFixtures;
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
 * Class GetAllClientsActionFunctionalTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllUsersActionFunctionalTest extends WebTestCase
{
//    use TestCaseTrait;
    use AuthenticationTestTrait;

    public function setup()
    {
        self::bootKernel();
        $em = static::$kernel->getContainer()->get('doctrine')->getManager();
        $usersFixtures = new UsersFixtures();
        $loader = new Loader();
        $purger = new ORMPurger($em);
        $executor = new ORMExecutor($em, $purger);
        $loader->addFixture($usersFixtures);
        $executor->execute($loader->getFixtures());
    }
    /**
     * @group functional
     */
    public function testGetStatusCodeWithoutAuthentication()
    {
        $client = $this->authenticate("BadUsername", "Badpassword");
        $client->request(
            'GET',
            '/users'
        );
        static::assertEquals(Response::HTTP_UNAUTHORIZED, $client->getResponse()->getStatusCode());
    }

    /**
     * @group functional
     */
    public function testGetStatusCodeWithAuthentication()
    {
        $client = $this->authenticate("Client1", "MySuperPassword");
        $client->request(
            'GET',
            '/users'
        );
        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        static::assertContains('username', $client->getResponse()->getContent());
        static::assertContains('password', $client->getResponse()->getContent());
        static::assertContains('firstName', $client->getResponse()->getContent());
        static::assertContains('lastName', $client->getResponse()->getContent());
        static::assertContains('mail', $client->getResponse()->getContent());
        static::assertContains('phone', $client->getResponse()->getContent());
        static::assertContains('inscriptionDate', $client->getResponse()->getContent());
        static::assertContains('address', $client->getResponse()->getContent());
        static::assertContains('way', $client->getResponse()->getContent());
        static::assertContains('zipCode', $client->getResponse()->getContent());
        static::assertContains('city', $client->getResponse()->getContent());
        static::assertContains('region', $client->getResponse()->getContent());
        static::assertContains('country', $client->getResponse()->getContent());
        static::assertContains('links', $client->getResponse()->getContent());
        static::assertContains('self', $client->getResponse()->getContent());
        static::assertContains('href', $client->getResponse()->getContent());
        static::assertContains('delete', $client->getResponse()->getContent());
    }

//    /**
//     * @group Blackfire
//     */
//    public function testOneTrickInvoke()
//    {
//        $config = new Configuration();
//        $config->assert('main.peak_memory < 100kB', 'AddImages memory usage');
//        $config->assert('main.wall_time < 45ms', 'AddImages walltime');
//        $config->assert('metrics.sql.queries.count = 0', 'AddImages walltime');
//        $this->assertBlackfire($config, function(){
//            $client = static::createClient();
//            $client->request('GET', '/trick/Figure_0');
//        });
//    }
}