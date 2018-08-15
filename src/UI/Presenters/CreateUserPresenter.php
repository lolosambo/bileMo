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

namespace App\UI\Presenters;

use App\Domain\Models\Addresses;
use App\Domain\Models\Users;
use App\Domain\Repository\Interfaces\AddressesRepositoryInterface;
use App\Domain\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Presenters\Interfaces\CreateUserPresenterInterface;
use App\UI\Responders\Interfaces\CreateUserResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CreateUserPresenter
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateUserPresenter implements CreateUserPresenterInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;

    /**
     * @var CreateUserResponderInterface
     */
    private $responder;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passEncoder;

    /**
     * @var TokenStorageInterface
     */
    private $token;

    /**
     * @var DenormalizerInterface
     */
    private $denormalizer;

    /**
     * @var AddressesRepositoryInterface
     */
    private $addressRepository;

    /**
     * CreateUserPresenter constructor.
     *
     * @param SerializerInterface $serializer
     * @param UsersRepositoryInterface $usersRepository
     * @param CreateUserResponderInterface $responder
     * @param UserPasswordEncoderInterface $passEncoder
     * @param TokenStorageInterface $token
     * @param DenormalizerInterface $denormalizer
     */
    public function __construct(
        SerializerInterface $serializer,
        UsersRepositoryInterface $usersRepository,
        AddressesRepositoryInterface $addressRepository,
        CreateUserResponderInterface $responder,
        UserPasswordEncoderInterface $passEncoder,
        TokenStorageInterface $token,
        DenormalizerInterface $denormalizer
    ) {
        $this->serializer = $serializer;
        $this->usersRepository = $usersRepository;
        $this->addressRepository = $addressRepository;
        $this->responder = $responder;
        $this->passEncoder = $passEncoder;
        $this->token = $token;
        $this->denormalizer = $denormalizer;
    }

    /**
     * @param $userData
     * @param $addressData
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function __invoke($userData, $addressData)
    {
        $client = $this->token->getToken()->getUser();
        $address = $this->denormalizer->denormalize(
            $addressData,
            Addresses::class
        );
        $user = $this->denormalizer->denormalize(
            $userData,
            Users::class
        );
        $user->setClient($client);
        $user->setAddress($address);
        $password = $user->getPassword();
        $user->setPassword($this->passEncoder->encodePassword($user, $password));
        $user->setPhone($userData['phone']);
        $this->usersRepository->save($user);
        $this->addressRepository->save($address);
        $responder = $this->responder;
        if($this->usersRepository->findOneByUserName($user->getUsername())) {
            return $responder();
        } else {
            throw new \Exception('Il y a eu un problème lors de l\'enregistrement de l\'utilisateur en base de données');
        }
    }
}
