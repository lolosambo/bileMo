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

    public function setup()
    {
        self::bootKernel();
        $em = static::$kernel->getContainer()->get('doctrine')->getManager();
        $productsFixtures = new ProductsFixtures();
        $loader = new Loader();
        $loader->addFixture($productsFixtures);
        $purger = new ORMPurger($em);
        $executor = new ORMExecutor($em, $purger);
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
            '/products'
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
            '/products'
        );
        static::assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        static::assertContains('name', $client->getResponse()->getContent());
        static::assertContains('brand', $client->getResponse()->getContent());
        static::assertContains('height', $client->getResponse()->getContent());
        static::assertContains('width', $client->getResponse()->getContent());
        static::assertContains('weight', $client->getResponse()->getContent());
        static::assertContains('screen', $client->getResponse()->getContent());
        static::assertContains('os', $client->getResponse()->getContent());
        static::assertContains('price', $client->getResponse()->getContent());
        static::assertContains('links', $client->getResponse()->getContent());
        static::assertContains('self', $client->getResponse()->getContent());
        static::assertContains('href', $client->getResponse()->getContent());
    }
}