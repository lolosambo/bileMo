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

use App\Domain\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Responders\Interfaces\DeleteUserResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Interface DeleteUserPresenterInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface DeleteUserPresenterInterface
{
    /**
     * DeleteUserPresenter constructor.
     *
     * @param UsersRepositoryInterface $usersRepository
     * @param DeleteUserResponderInterface $responder
     */
    public function __construct(
        UsersRepositoryInterface $usersRepository,
        DeleteUserResponderInterface $responder
    );

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function prepare(Request $request): Response;
}
