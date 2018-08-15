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
use App\UI\Actions\Interfaces\DeleteUserActionInterface;
use App\UI\Presenters\Interfaces\DeleteUserPresenterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Laurent BERTON <lolosambo2@gmail.com>
 *
 * Class DeleteUserAction
 *
 * @Route(
 *     path="/user/delete/{id}",
 *     name="deleteUser",
 *     methods={"DELETE"},
 *     defaults={
 *         "_request_handler": "App\Application\Request\Handlers\DeleteUserHandler"
 *     }
 * )
 */
class DeleteUserAction implements DeleteUserActionInterface
{
    /**
     * @var UsersRepositoryInterface
     */
    private $usersRepository;

    /**
     * DeleteUserAction constructor.
     *
     * @param UsersRepositoryInterface $usersRepository
     */
    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * @param Request $request
     * @param DeleteUserPresenterInterface $presenter
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(Request $request, DeleteUserPresenterInterface $presenter)
    {
        $this->usersRepository->deleteUser($request->attributes->get("id"));
        return $presenter($request);
    }

}