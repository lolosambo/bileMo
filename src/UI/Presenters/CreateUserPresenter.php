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

use App\Domain\Models\Users;
use App\Domain\Repository\Interfaces\ClientsRepositoryInterface;
use App\Domain\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Presenters\Interfaces\CreateUserPresenterInterface;
use App\UI\Responders\Interfaces\CreateUserResponderInterface;
use Symfony\Component\HttpFoundation\Request;
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
     * @var ClientsRepositoryInterface
     */
    private $clientsRepository;

    /**
     * @var CreateUserResponderInterface
     */
    private $responder;

    /**
     * CreateUserPresenter constructor.
     *
     * @param SerializerInterface $serializer
     * @param UsersRepositoryInterface $usersRepository
     * @param ClientsRepositoryInterface $clientsRepository
     * @param CreateUserResponderInterface $responder
     */
    public function __construct(
        SerializerInterface $serializer,
        UsersRepositoryInterface $usersRepository,
        ClientsRepositoryInterface $clientsRepository,
        CreateUserResponderInterface $responder
    ) {
        $this->serializer = $serializer;
        $this->usersRepository = $usersRepository;
        $this->clientsRepository = $clientsRepository;
        $this->responder = $responder;
    }

    /**
     * @param $data
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     */
    public function __invoke(Request $request, $data)
    {
        $client = $this->clientsRepository->findClient($request->attributes->get('id'));
        $user = $this->serializer->deserialize(
            $data,
            Users::class,
            'json'
        );
        $user->setClient($client);
        $this->usersRepository->save($user);
        $responder = $this->responder;
        if($this->usersRepository->findOneByUserName($user->getUsername())) {
            return $responder();
        } else {
            throw new \Exception('Il y a eu un problème lors de l\'enregistrement du client en base de données');
        }
    }
}
