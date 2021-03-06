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

use App\UI\Presenters\Interfaces\GetProductPresenterInterface;
use App\UI\Responders\GetProductResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetProductResponderTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetProductResponderTest extends TestCase
{

    private $responder;

    public function setUp()
    {
        $presenter = $this->createMock(GetProductPresenterInterface::class);
        $this->responder = new GetProductResponder($presenter);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetProductResponder::class, $this->responder);
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

