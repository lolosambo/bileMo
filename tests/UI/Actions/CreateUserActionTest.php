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

use App\UI\Actions\CreateUserAction;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

/**
 * Class CreateUserActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateUserActionTest extends TestCase
{

    private $action;

    public function setUp()
    {
        $decoder = $this->createMock(DecoderInterface::class);
        $this->action = new CreateUserAction($decoder);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(CreateUserAction::class, $this->action);
    }

}

