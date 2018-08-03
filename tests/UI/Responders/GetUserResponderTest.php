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

use App\UI\Presenters\Interfaces\GetUserPresenterInterface;
use App\UI\Responders\GetUserResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class GetUserResponderTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetUserResponderTest extends TestCase
{

    private $responder;

    public function setUp()
    {
        $presenter = $this->createMock(GetUserPresenterInterface::class);
        $this->responder = new GetUserResponder($presenter);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetUserResponder::class, $this->responder);
    }

    /**
     * @group unit
     */
    public function testInvoke()
    {
        $data= 'dataTest';
        $responder = $this->responder;
        $result = $responder($data);
        static::assertInstanceOf(JsonResponse::class, $result);
    }
}

