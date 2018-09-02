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

use App\Domain\Models\Interfaces\UsersInterface;
use App\Domain\Models\Users;
use App\UI\Presenters\GetUserPresenter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GetUserPresenterTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetUserPresenterTest extends KernelTestCase
{

    private $presenter;

    private $user;


    /**
     * @throws \Exception
     */
    public function setUp()
    {
        self::bootKernel();
        $serializer= self::$kernel->getContainer()->get('serializer');
        $this->presenter = new GetUserPresenter($serializer);

        $this->user = new Users(
            'User1',
            'SomePassword',
            'Laurent',
            'Berton',
            'test@email.com'
        );
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetUserPresenter::class, $this->presenter);
    }

    /**
     * @group unit
     */
    public function testInvoke()
    {
        $request = $this->createMock(Request::class);
        $presenter = $this->presenter;
        $result = $presenter($request, $this->user);
        static::assertInstanceOf(UsersInterface::class, $this->user);
        static::assertInternalType('string', $result);
    }
}