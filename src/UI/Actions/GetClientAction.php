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
use App\UI\Actions\Interfaces\GetClientActionInterface;
use App\UI\Responders\Interfaces\GetClientResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 *  * @author Laurent BERTON <lolosambo2@gmail.com>
 *
 * Class GetClientAction
 *
 * @Route(path="/client/{id}", name="showClient", methods={"GET"})
 */
class GetClientAction implements GetClientActionInterface
{
    /**
     * @var ClientsRepositoryInterface
     */
    private $repository;

    /**
     * GetClientAction constructor.
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
     * @param GetClientResponderInterface $responder
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function __invoke(Request $request, GetClientResponderInterface $responder)
    {
        $data = $this->repository->findClient($request->attributes->get('id'));
        return $responder($data);
    }

}

