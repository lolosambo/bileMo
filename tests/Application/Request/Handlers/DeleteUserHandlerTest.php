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

use App\Application\Request\Handlers\DeleteUserHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DeleteUserHandlerTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class DeleteUserHandlerTest extends TestCase
{
    private $action;

    private $request;

    public function setUp()
    {
        $this->request = new Request(
            [],
            [
                'DELETE',
                '/delete_user/352e0c3f-cf98-4564-9e14-013724fde2a9'
            ]
        );
        $this->action = new DeleteUserHandler();
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(DeleteUserHandler::class, $this->action);
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
