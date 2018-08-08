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
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetAllProductsActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllProductsActionTest extends TestCase
{

    private $action;

    public function setUp()
    {
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
        $result = $action($responder);
        static::assertInstanceOf(Response::class, $result);
    }
}







