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

use App\UI\Responders\CreateClientResponder;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CreateClientResponderTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateClientResponderTest extends TestCase
{

    private $responder;

    public function setUp()
    {
        $this->responder = new CreateClientResponder();
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(CreateClientResponder::class, $this->responder);
    }

    /**
     * @group unit
     */
    public function testInvoke()
    {
        $responder = $this->responder;
        $result = $responder();
        static::assertInstanceOf(Response::class, $result);
    }
}

