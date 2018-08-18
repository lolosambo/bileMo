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
    private $responder;

    private $presenter;

    /**
     * @throws \Exception
     */
    public function setUp()
    {
        $this->responder = $this->createMock(CreateUserResponderInterface::class);
        $this->presenter = new CreateUserPresenter($this->responder);
//        $user = [];
//        $user["username"] = "User125";
//        $user["password"] = "somePassword";
//        $user["firstName"] = "Laurent";
//        $user["lastName"] = "BERTON";
//        $user["mail"] = "test@mail.com";
//        $user["address"] = [
//            "number" => 20,
//            "way" => "allée Baudelaire",
//            "zipCode" => 59139,
//            "city" => "Wattignies",
//            "region" => "Nord",
//            "country" => "FRANCE"
//            ];
//        $this->user = json_encode($user);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(CreateUserPresenter::class, $this->presenter);
    }
}

