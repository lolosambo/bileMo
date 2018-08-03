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
use App\UI\Actions\GetUserAction;
use App\UI\Presenters\Interfaces\GetUserPresenterInterface;
use App\UI\Responders\GetUserResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GetUserActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetUserActionTest extends TestCase
{

    private $action;

    public function setUp()
    {
        $repository = $this->createMock(UsersRepositoryInterface::class);
        $this->action = new GetUserAction($repository);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetUserAction::class, $this->action);
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
                '/user/'
            ],
            ['id' => '1be74127-739b-486c-8da7-bc4f9943e525']
        );
        $presenter = $this->createMock(GetUserPresenterInterface::class);
        $responder = new GetUserResponder($presenter);
        $action = $this->action;
        $result = $action($request, $responder);
        static::assertInstanceOf(JsonResponse::class, $result);
    }
}

