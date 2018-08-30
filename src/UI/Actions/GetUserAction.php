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
use App\UI\Actions\Interfaces\GetUserActionInterface;
use App\UI\Responders\Interfaces\GetUserResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 *  * @author Laurent BERTON <lolosambo2@gmail.com>
 *
 * Class GetUserAction
 *
 * @Route(
 *     path="/users/{id}",
 *     name="getUser",
 *     methods={"GET"},
 *     defaults={
 *         "_request_handler": "App\Application\Request\Handlers\GetUserHandler"
 *     }
 * )
 */
class GetUserAction implements GetUserActionInterface
{
    /**
     * @var UsersRepositoryInterface
     */
    private $repository;

    /**
     * GetUserAction constructor.
     *
     * @param UsersRepositoryInterface $repository
     * @param SerializerInterface $serializer
     */
    public function __construct(UsersRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param GetUserResponderInterface $responder
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function __invoke(Request $request, GetUserResponderInterface $responder)
    {
        $data = $this->repository->findUser($request->attributes->get('id'));
        return $responder($request, $data);
    }

}

