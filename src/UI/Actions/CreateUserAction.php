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

namespace App\UI\Actions;

use App\Domain\Models\Addresses;
use App\Domain\Models\Users;
use App\Domain\Repository\Interfaces\AddressesRepositoryInterface;
use App\Domain\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Actions\Interfaces\CreateUserActionInterface;
use App\UI\Presenters\Interfaces\CreateUserPresenterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @author Laurent BERTON <lolosambo2@gmail.com>
 *
 * Class CreateUserAction
 *
 * @Route(
 *     path="/users/create",
 *     name="createUser",
 *     methods={"POST"},
 *     defaults={
 *         "_request_handler": "App\Application\Request\Handlers\CreateUserHandler"
 *     }
 * )
 */
class CreateUserAction implements CreateUserActionInterface
{
    /**
     * @var DecoderInterface
     */
    private $decoder;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;

    /**
     * @var ValidatorInterface
     */
    private $validator;

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
     * CreateUserAction constructor.
     * @param DecoderInterface $decoder
     * @param SerializerInterface $serializer
     * @param UsersRepositoryInterface $usersRepository
     * @param AddressesRepositoryInterface $addressRepository
     * @param UserPasswordEncoderInterface $passEncoder
     * @param TokenStorageInterface $token
     * @param DenormalizerInterface $denormalizer
     * @param ValidatorInterface $validator
     */
    public function __construct(
        DecoderInterface $decoder,
        SerializerInterface $serializer,
        UsersRepositoryInterface $usersRepository,
        AddressesRepositoryInterface $addressRepository,
        UserPasswordEncoderInterface $passEncoder,
        TokenStorageInterface $token,
        DenormalizerInterface $denormalizer,
        ValidatorInterface $validator
    ) {
        $this->decoder = $decoder;
        $this->serializer = $serializer;
        $this->usersRepository = $usersRepository;
        $this->addressRepository = $addressRepository;
        $this->passEncoder = $passEncoder;
        $this->token = $token;
        $this->denormalizer = $denormalizer;
        $this->validator = $validator;
    }

    /**
     * @param Request $request
     * @param CreateUserPresenterInterface $presenter
     *
     * @return mixed|\Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     */
    public function __invoke(Request $request, CreateUserPresenterInterface $presenter)
    {
        $data = $request->getContent();
        $userData = $this->decoder->decode($data, 'json');
        $addressData = $userData['address'];
        unset($userData['address']);

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
        $user->setPhone($userData['phone']);
        $password = $user->getPassword();
        $userErrors = $this->validator->validate($user, null, ['user']);
        $addressErrors = $this->validator->validate($address, null, ['address']);
        $user->setPassword($this->passEncoder->encodePassword($user, $password));
        $messages = [];
        if((\count($userErrors) > 0) || (\count($addressErrors) > 0)) {
            foreach($userErrors as $error) {
                $messages[] = $error->getMessage();
            }
            foreach($addressErrors as $error) {
                $messages[] = $error->getMessage();
            }
            $response = new JsonResponse($messages);
            return $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }
        $this->usersRepository->save($user);
        $this->addressRepository->save($address);

        return $presenter();
    }
}


