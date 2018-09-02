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
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetAllClientsActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllClientsActionTest extends WebTestCase
{

    private $action;
    private $request;

    public function setUp()
    {
        $client = static::createClient();
        $client->request('GET', '/clients');
        $this->request = $client;
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
        $result = $action($this->request->getRequest(), $responder);
        static::assertInstanceOf(Response::class, $result);
    }
}

