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

use App\Application\Request\Handlers\GetAllProductsHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GetAllProductsActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllProductsHandlerTest extends TestCase
{

    private $action;

    private $request;

    public function setUp()
    {
        $this->request = new Request(
            [],
            [
                'GET',
                '/show_all_products'
            ]
        );
        $this->action = new GetAllProductsHandler();
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetAllProductsHandler::class, $this->action);
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







