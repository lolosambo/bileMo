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

use App\Application\Request\Handlers\CreateUserHandler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CreateUserHandlerTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateUserHandlerTest extends TestCase
{
    private $action;

    private $request;

    public function setUp()
    {
        $this->request = new Request(
            [],
            [
                'POST',
                '/create_user/client/875df3c7-8d6b-4496-8aef-e1ab59c8f118'
            ]
        );
        $this->action = new CreateUserHandler();
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(CreateUserHandler::class, $this->action);
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
