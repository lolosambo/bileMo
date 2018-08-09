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
use App\UI\Presenters\Interfaces\DeleteUserPresenterInterface;
use App\UI\Responders\Interfaces\DeleteUserResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class DeleteUserPresenter
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class DeleteUserPresenter implements DeleteUserPresenterInterface
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
     * @var DeleteUserResponderInterface
     */
    private $responder;

    /**
     * DeleteUserPresenter constructor.
     *
     * @param SerializerInterface $serializer
     * @param UsersRepositoryInterface $usersRepository
     * @param DeleteUserResponderInterface $responder
     */
    public function __construct(
        SerializerInterface $serializer,
        UsersRepositoryInterface $usersRepository,
        DeleteUserResponderInterface $responder
    ) {
        $this->serializer = $serializer;
        $this->usersRepository = $usersRepository;
        $this->responder = $responder;
    }

    /**
     * @param Request $request
     *
     * @return DeleteUserResponderInterface
     *
     * @throws \Exception
     */
    public function __invoke(Request $request)
    {
        $responder = $this->responder;
        if($this->usersRepository->findUser($request->attributes->get("id"))) {
            throw new \Exception('Il y a eu un problème lors de l\'effacement de l\'utilisateur de la base de données');
        } else {
            return $responder;
        }
    }
}

