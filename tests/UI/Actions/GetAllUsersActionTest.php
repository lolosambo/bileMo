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

use App\Domain\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Actions\GetAllUsersAction;
use App\UI\Presenters\Interfaces\GetAllUsersPresenterInterface;
use App\UI\Responders\GetAllUsersResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GetAllUsersActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllUsersActionTest extends TestCase
{

    private $action;

    public function setUp()
    {
        $repository = $this->createMock(UsersRepositoryInterface::class);
        $this->action = new GetAllUsersAction($repository);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetAllUsersAction::class, $this->action);
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
                '/show_all_users_by_client/'
            ],
            ['id' => '48260ac9-1c23-44c2-a86a-726d5249bd52']
        );
        $presenter = $this->createMock(GetAllUsersPresenterInterface::class);
        $responder = new GetAllUsersResponder($presenter);
        $action = $this->action;
        $result = $action($request, $responder);
        static::assertInstanceOf(Response::class, $result);
    }
}

