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
use App\UI\Presenters\DeleteUserPresenter;
use App\UI\Responders\Interfaces\DeleteUserResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class DeleteUserPresenterTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class DeleteUserPresenterTest extends KernelTestCase
{
    private $presenter;

    private $usersRepository;


    /**
     * @throws \Exception
     */
    public function setUp()
    {
        self::bootKernel();
        $serializer = self::$kernel->getContainer()->get('serializer');
        $responder = $this->createMock(DeleteUserResponderInterface::class);
        $this->usersRepository = $this->createMock(UsersRepositoryInterface::class);

        $this->presenter = new DeleteUserPresenter(
            $this->usersRepository,
            $responder
        );
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(DeleteUserPresenter::class, $this->presenter);
    }
}

