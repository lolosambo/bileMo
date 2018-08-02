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

use App\Domain\Repository\Interfaces\ClientsRepositoryInterface;
use App\UI\Actions\GetClientAction;
use App\UI\Presenters\Interfaces\GetClientPresenterInterface;
use App\UI\Responders\GetClientResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GetClientActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetClientActionTest extends TestCase
{

    private $action;

    public function setUp()
    {
        $repository = $this->createMock(ClientsRepositoryInterface::class);
        $this->action = new GetClientAction($repository);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetClientAction::class, $this->action);
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
                '/client/'
            ],
            ['id' => '7b230874-95ed-411a-b269-3cd41c834d92']
        );
        $presenter = $this->createMock(GetclientPresenterInterface::class);
        $responder = new GetClientResponder($presenter);
        $action = $this->action;
        $result = $action($request, $responder);
        static::assertInstanceOf(JsonResponse::class, $result);
    }
}

