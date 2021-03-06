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

namespace Tests\UI\Responders;

use App\UI\Presenters\Interfaces\GetAllClientsPresenterInterface;
use App\UI\Responders\GetAllClientsResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GetAllClientsResponderTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllClientsResponderTest extends TestCase
{

    private $responder;

    public function setUp()
    {
        $presenter = $this->createMock(GetAllClientsPresenterInterface::class);
        $this->responder = new GetAllClientsResponder($presenter);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetAllClientsResponder::class, $this->responder);
    }

    /**
     * @group unit
     */
    public function testInvoke()
    {
        $data = ['data1', 'data2', 'data3'];
        $result = $this->responder->returnResponse($data);
        static::assertInstanceOf(JsonResponse::class, $result);
    }
}

