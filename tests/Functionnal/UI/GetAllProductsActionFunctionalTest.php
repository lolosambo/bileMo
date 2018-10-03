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

use App\Domain\DataFixtures\ORM\ProductsFixtures;
use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Blackfire\Profile\Configuration;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Tests\Traits\AuthenticationTestTrait;

/**
 * Class GetAllProductsActionFunctionalTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllProductsActionFunctionalTest extends WebTestCase
{
//    use TestCaseTrait;
    use AuthenticationTestTrait;

    private $client;

    public function setup()
    {
        self::bootKernel();
        $this->client = self::createClient();
        $em = static::$kernel->getContainer()->get('doctrine')->getManager();
        $productsFixtures = new ProductsFixtures();
        $loader = new Loader();
        $loader->addFixture($productsFixtures);
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
            "BadUsername",
            "Badpassword"
        );
        $this->client->request(
            'GET',
            '/products',
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
            '/products',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_Authorization' => "Bearer ".$token
            ]
        );
        static::assertEquals(
            Response::HTTP_OK,
            $this->client->getResponse()->getStatusCode()
        );
        static::assertContains(
            'name',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'brand',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'height',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'width',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'weight',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'screen',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'os',
            $this->client->getResponse()->getContent()
        );
        static::assertContains(
            'price',
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