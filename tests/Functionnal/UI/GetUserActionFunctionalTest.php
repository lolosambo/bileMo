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
 * Class GetUserActionFunctionalTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetUserActionFunctionalTest extends WebTestCase
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
            '/users/25c20571-2cf8-4b2f-85cc-1a31375ada39'
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
            '/users/25c20571-2cf8-4b2f-85cc-1a31375ada39'
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
}