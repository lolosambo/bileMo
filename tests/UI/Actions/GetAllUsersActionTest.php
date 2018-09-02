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
use App\UI\Actions\GetAllUsersAction;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class GetAllUsersActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllUsersActionTest extends WebTestCase
{

    private $action;
    private $request;

    public function setUp()
    {
        $client = static::createClient();
        $client->request('GET', '/users');
        $this->request = $client;
        $repository = $this->createMock(UsersRepositoryInterface::class);
        $token = $this->createMock(TokenStorageInterface::class);
        $this->action = new GetAllUsersAction($repository, $token);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetAllUsersAction::class, $this->action);
    }
}

