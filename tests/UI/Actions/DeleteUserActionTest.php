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

use App\Domain\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Actions\DeleteUserAction;
use PHPUnit\Framework\TestCase;

/**
 * Class DeleteUserActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class DeleteUserActionTest extends TestCase
{

    private $action;

    public function setUp()
    {
        $repository = $this->createMock(UsersRepositoryInterface::class);
        $this->action = new DeleteUserAction($repository);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(DeleteUserAction::class, $this->action);
    }

}
