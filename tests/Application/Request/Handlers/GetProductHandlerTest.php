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

namespace Tests\Application\Request\Handlers;

use App\Application\Request\Handlers\GetProductHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GetProductActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetProductHandlerTest extends TestCase
{

    private $action;

    private $request;

    public function setUp()
    {
        $this->request = new Request(
            [],
            [
                'GET',
                '/product/6232fab1-05d3-48b0-9825-9c2b5c78b380'
            ]
        );
        $this->action = new GetProductHandler();
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetProductHandler::class, $this->action);
    }

    /**
     * @group unit
     */
    public function testHandleMethod()
    {
        $result = $this->action->handle($this->request);
        static::assertInstanceOf(Request::class, $result);
    }
}
