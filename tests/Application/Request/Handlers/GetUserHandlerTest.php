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

use App\Application\Request\Handlers\GetUserHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GetUserActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetUserHandlerTest extends TestCase
{

    private $action;

    private $request;

    public function setUp()
    {
        $this->request = new Request(
            [],
            [
                'GET',
                '/user/1be74127-739b-486c-8da7-bc4f9943e525'
            ]
        );
        $this->action = new GetUserHandler();
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetUserHandler::class, $this->action);
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
