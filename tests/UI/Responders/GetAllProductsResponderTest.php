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

use App\UI\Presenters\Interfaces\GetAllProductsPresenterInterface;
use App\UI\Responders\GetAllProductsResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetAllProductsResponderTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllProductsResponderTest extends TestCase
{

    private $responder;

    public function setUp()
    {
        $presenter = $this->createMock(GetAllProductsPresenterInterface::class);
        $this->responder = new GetAllProductsResponder($presenter);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetAllProductsResponder::class, $this->responder);
    }

    /**
     * @group unit
     */
    public function testInvoke()
    {
        $data = ['data1', 'data2', 'data3'];
        $responder = $this->responder;
        $result = $responder($data);
        static::assertInstanceOf(Response::class, $result);
    }
}

