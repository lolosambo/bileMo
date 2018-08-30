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

use App\Domain\Repository\Interfaces\AddressesRepositoryInterface;
use App\Domain\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Actions\CreateUserAction;
use App\UI\Responders\Interfaces\CreateUserResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class CreateUserActionTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateUserActionTest extends KernelTestCase
{
    private $action;

    private $serializer;

    private $decoder;

    private $token;

    private $denormalizer;

    private $usersRepository;

    private $addressRepository;

    private $validator;


    public function setUp()
    {
        self::bootKernel();
        $decoder = $this->createMock(DecoderInterface::class);
        $serializer = self::$kernel->getContainer()->get('serializer');
        $usersRepository = $this->createMock(UsersRepositoryInterface::class);
        $token = $this->createMock(TokenStorageInterface::class);
        $denormalizer = $this->createMock(DenormalizerInterface::class);
        $addressRepository = $this->createMock(AddressesRepositoryInterface::class);
        $validator = $this->createMock(ValidatorInterface::class);
        $passEncoder = $this->createMock(UserPasswordEncoderInterface::class);
        $responder = $this->createMock(CreateUserResponderInterface::class);

        $this->action = new CreateUserAction(
            $decoder,
            $serializer,
            $usersRepository,
            $addressRepository,
            $passEncoder,
            $token,
            $denormalizer,
            $validator,
            $responder
        );
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(CreateUserAction::class, $this->action);
    }

}

