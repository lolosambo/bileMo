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

use App\UI\Presenters\Interfaces\GetAllUsersPresenterInterface;
use App\UI\Responders\GetAllUsersResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class GetAllUsersResponderTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllUsersResponderTest extends TestCase
{

    private $responder;

    public function setUp()
    {
        $presenter = $this->createMock(GetAllUsersPresenterInterface::class);
        $this->responder = new GetAllUsersResponder($presenter);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetAllUsersResponder::class, $this->responder);
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

