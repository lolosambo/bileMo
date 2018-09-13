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

use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Tests\Traits\AuthenticateTrait;
use Blackfire\Profile\Configuration;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
/**
 * Class GetAllClientsActionFunctionalTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllClientsActionFunctionalTest extends WebTestCase
{
//    use TestCaseTrait;
      use AuthenticateTrait;

    /**
     * @group functional
     */
    public function testGetStatusCodeWithoutAuthentication()
    {
        $client = $this->authenticate("BadUsername", "Badpassword");
        $client->request(
            'GET',
            '/clients'
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
            '/clients'
        );
        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        static::assertContains('username', $client->getResponse()->getContent());
        static::assertContains('password', $client->getResponse()->getContent());
        static::assertContains('mail', $client->getResponse()->getContent());
        static::assertContains('inscription_date', $client->getResponse()->getContent());
        static::assertContains('links', $client->getResponse()->getContent());
        static::assertContains('self', $client->getResponse()->getContent());
        static::assertContains('href', $client->getResponse()->getContent());
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