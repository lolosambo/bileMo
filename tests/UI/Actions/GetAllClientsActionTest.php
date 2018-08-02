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
use App\UI\Actions\GetAllClientsAction;
use App\UI\Presenters\Interfaces\GetAllClientsPresenterInterface;
use App\UI\Responders\GetAllClientsResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class GetAllClientsActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllClientsActionTest extends TestCase
{

    private $action;

    public function setUp()
    {
        $repository = $this->createMock(ClientsRepositoryInterface::class);
        $this->action = new GetAllClientsAction($repository);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetAllClientsAction::class, $this->action);
    }

    /**
     * @group unit
     */
    public function testInvoke()
    {
        $presenter = $this->createMock(GetAllclientsPresenterInterface::class);
        $responder = new GetAllClientsResponder($presenter);
        $action = $this->action;
        $result = $action($responder);
        static::assertInstanceOf(JsonResponse::class, $result);
    }
}

