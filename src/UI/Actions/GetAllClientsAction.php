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

use App\Domain\Repository\Interfaces\ClientsRepositoryInterface;
use App\UI\Actions\Interfaces\GetAllClientsActionInterface;
use App\UI\Responders\Interfaces\GetAllClientsResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 *  * @author Laurent BERTON <lolosambo2@gmail.com>
 *
 * Class GetAllClientsAction
 *
 * @Route(
 *     name="getAllClients",
 *     path="/clients",
 *     methods={"GET"},
 *     defaults={
 *         "_request_handler": "App\Application\Request\Handlers\GetAllClientsHandler"
 *     }
 * )
 */
class GetAllClientsAction implements GetAllClientsActionInterface
{
    /**
     * @var ClientsRepositoryInterface
     */
    private $repository;

    /**
     * GetAllClientsAction constructor.
     *
     * @param ClientsRepositoryInterface $repository
     * @param SerializerInterface $serializer
     */
    public function __construct(ClientsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param GetAllClientsResponderInterface $responder
     *
     * @return string
     */
    public function __invoke(
        Request $request,
        GetAllClientsResponderInterface $responder
    ) {
        $data = $this->repository->findAllClients();
        return $responder->returnResponse(
            $request,
            $data
        );
    }
}
