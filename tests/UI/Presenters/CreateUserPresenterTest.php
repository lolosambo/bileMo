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

namespace Tests\UI\Presenters;

use App\Domain\Repository\Interfaces\ClientsRepositoryInterface;
use App\Domain\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Presenters\CreateUserPresenter;
use App\UI\Responders\Interfaces\CreateUserResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class CreateUserPresenterTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateUserPresenterTest extends KernelTestCase
{
    private $presenter;

    private $client;

    private $usersRepository;

    private $clientsRepository;

    /**
     * @throws \Exception
     */
    public function setUp()
    {
        self::bootKernel();
        $serializer = self::$kernel->getContainer()->get('serializer');
        $responder = $this->createMock(CreateUserResponderInterface::class);
        $this->usersRepository = $this->createMock(UsersRepositoryInterface::class);
        $this->clientsRepository = $this->createMock(ClientsRepositoryInterface::class);

        $this->presenter = new CreateUserPresenter(
            $serializer,
            $this->usersRepository,
            $this->clientsRepository,
            $responder
        );

        $user = [];
        $user["username"] = "User125";
        $user["password"] = "somePassword";
        $user["firstName"] = "Laurent";
        $user["lastName"] = "BERTON";
        $user["mail"] = "test@mail.com";
        $this->user = json_encode($user);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(CreateUserPresenter::class, $this->presenter);
    }
}

