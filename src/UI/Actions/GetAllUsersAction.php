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

use App\Domain\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Actions\Interfaces\GetAllUsersActionInterface;
use App\UI\Responders\Interfaces\GetAllUsersResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 *  * @author Laurent BERTON <lolosambo2@gmail.com>
 *
 * Class GetAllUsersAction
 *
 * @Route(
 *     name="getAllUsers",
 *     path="/users",
 *     methods={"GET"},
 *     defaults={
 *         "_request_handler": "App\Application\Request\Handlers\GetAllUsersHandler"
 *     }
 * )
 */
class GetAllUsersAction implements GetAllUsersActionInterface
{
    /**
     * @var UsersRepositoryInterface
     */
    private $repository;

    /**
     * @var TokenStorageInterface
     */
    private $token;

    /**
     * GetAllUsersAction constructor.
     *
     * @param UsersRepositoryInterface $repository
     * @param SerializerInterface $serializer
     */
    public function __construct(
        UsersRepositoryInterface $repository,
        TokenStorageInterface $token
    ) {
        $this->repository = $repository;
        $this->token = $token;
    }

    /**
     * @param GetAllUsersResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function __invoke(GetAllUsersResponderInterface $responder)
    {
        $client = $this->token->getToken()->getUser();
        $data = $this->repository->findAllUsersByClient($client->getId()->toString());
        return $responder($data);
    }

}

