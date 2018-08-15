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

use App\Domain\Repository\Interfaces\AddressesRepositoryInterface;
use App\Domain\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Presenters\CreateUserPresenter;
use App\UI\Responders\Interfaces\CreateUserResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class CreateUserPresenterTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateUserPresenterTest extends KernelTestCase
{
    private $serializer;

    private $responder;

    private $encoder;

    private $token;

    private $denormalizer;

    private $presenter;

    private $usersRepository;

    private $addressRepository;

    /**
     * @throws \Exception
     */
    public function setUp()
    {
        self::bootKernel();
        $this->serializer = self::$kernel->getContainer()->get('serializer');
        $this->responder = $this->createMock(CreateUserResponderInterface::class);
        $this->usersRepository = $this->createMock(UsersRepositoryInterface::class);
        $this->encoder = $this->createMock(UserPasswordEncoderInterface::class);
        $this->token = $this->createMock(TokenStorageInterface::class);
        $this->denormalizer = $this->createMock(DenormalizerInterface::class);
        $this->addressRepository = $this->createMock(AddressesRepositoryInterface::class);

        $this->presenter = new CreateUserPresenter(
            $this->serializer,
            $this->usersRepository,
            $this->addressRepository,
            $this->responder,
            $this->encoder,
            $this->token,
            $this->denormalizer
        );

        $user = [];
        $user["username"] = "User125";
        $user["password"] = "somePassword";
        $user["firstName"] = "Laurent";
        $user["lastName"] = "BERTON";
        $user["mail"] = "test@mail.com";
        $user["address"] = [
            "number" => 20,
            "way" => "allée Baudelaire",
            "zipCode" => 59139,
            "city" => "Wattignies",
            "region" => "Nord",
            "country" => "FRANCE"
            ];
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

