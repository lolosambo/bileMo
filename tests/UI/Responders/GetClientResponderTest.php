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

use App\UI\Presenters\Interfaces\GetClientPresenterInterface;
use App\UI\Responders\GetClientResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetClientResponderTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetClientResponderTest extends TestCase
{

    private $responder;

    public function setUp()
    {
        $presenter = $this->createMock(GetClientPresenterInterface::class);
        $this->responder = new GetClientResponder($presenter);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetClientResponder::class, $this->responder);
    }

    /**
     * @group unit
     */
    public function testInvoke()
    {
        $request = $this->createMock(Request::class);
        $data= 'dataTest';
        $result = $this->responder->returnResponse($request, $data);
        static::assertInstanceOf(Response::class, $result);
    }
}

