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

use App\UI\Actions\CreateClientAction;
use PHPUnit\Framework\TestCase;

/**
 * Class CreateClientActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateClientActionTest extends TestCase
{

    private $action;

    public function setUp()
    {
        $this->action = new CreateClientAction();
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(CreateClientAction::class, $this->action);
    }

}

