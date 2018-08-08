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
use App\UI\Actions\GetProductAction;
use App\UI\Presenters\Interfaces\GetProductPresenterInterface;
use App\UI\Responders\GetProductResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GetProductActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetProductActionTest extends TestCase
{

    private $action;

    public function setUp()
    {
        $repository = $this->createMock(ProductsRepositoryInterface::class);
        $this->action = new GetProductAction($repository);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetProductAction::class, $this->action);
    }

    /**
     * @group unit
     */
    public function testInvoke()
    {
        $request = new Request(
            [],
            [
                'GET',
                '/product/'
            ],
            ['id' => 'dc7f3418-eeea-4f9d-a0c9-cd3c42e3c940']
        );
        $presenter = $this->createMock(GetproductPresenterInterface::class);
        $responder = new GetProductResponder($presenter);
        $action = $this->action;
        $result = $action($request, $responder);
        static::assertInstanceOf(Response::class, $result);
    }
}

