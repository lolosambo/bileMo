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

namespace App\UI\Presenters\Interfaces;

use App\Domain\Repository\Interfaces\AddressesRepositoryInterface;
use App\Domain\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Responders\Interfaces\CreateUserResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
* Interface CreateUserPresenterInterface
*
* @author Laurent BERTON <lolosambo2@gmail.com>
*/
Interface CreateUserPresenterInterface
{
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
    );

    /**
     * @param $userData
     * @param $addressData
     *
     * @return mixed
     */
    public function __invoke($userData, $addressData);
}

