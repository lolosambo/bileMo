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

use App\Domain\Repository\Interfaces\ProductsRepositoryInterface;
use App\UI\Actions\GetAllProductsAction;
use App\UI\Presenters\Interfaces\GetAllProductsPresenterInterface;
use App\UI\Responders\GetAllProductsResponder;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetAllProductsActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllProductsActionTest extends WebTestCase
{

    private $action;
    private $request;

    public function setUp()
    {
        $client = static::createClient();
        $client->request('GET', '/products');
        $this->request = $client;
        $repository = $this->createMock(ProductsRepositoryInterface::class);
        $this->action = new GetAllProductsAction($repository);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetAllProductsAction::class, $this->action);
    }

    /**
     * @group unit
     */
    public function testInvoke()
    {
        $presenter = $this->createMock(GetAllproductsPresenterInterface::class);
        $responder = new GetAllProductsResponder($presenter);
        $action = $this->action;
        $result = $action($this->request->getRequest(),$responder);
        static::assertInstanceOf(Response::class, $result);
    }
}







