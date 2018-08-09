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

use App\Domain\Repository\Interfaces\ClientsRepositoryInterface;
use App\Domain\Repository\Interfaces\UsersRepositoryInterface;
use App\UI\Responders\Interfaces\CreateUserResponderInterface;
use Symfony\Component\HttpFoundation\Request;
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
    * @param ClientsRepositoryInterface $clientsRepository
    * @param CreateUserResponderInterface $responder
    */
    public function __construct(
        SerializerInterface $serializer,
        UsersRepositoryInterface $usersRepository,
        ClientsRepositoryInterface $clientsRepository,
        CreateUserResponderInterface $responder
    );

    /**
    * @param $data
    *
    * @return mixed|\Symfony\Component\HttpFoundation\Response
    *
    * @throws \Doctrine\ORM\NonUniqueResultException
    * @throws \Exception
    */
    public function __invoke(Request $request, $data);
}

