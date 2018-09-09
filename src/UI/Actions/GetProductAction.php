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

use App\Domain\Repository\Interfaces\ProductsRepositoryInterface;
use App\UI\Actions\Interfaces\GetProductActionInterface;
use App\UI\Responders\Interfaces\GetProductResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 *  * @author Laurent BERTON <lolosambo2@gmail.com>
 *
 * Class GetProductAction
 *
 * @Route(
 *     path="/products/{id}",
 *     name="getProduct",
 *     methods={"GET"},
 *     defaults={
 *         "_request_handler": "App\Application\Request\Handlers\GetProductHandler"
 *     }
 * )
 */
class GetProductAction implements GetProductActionInterface
{
    /**
     * @var ProductsRepositoryInterface
     */
    private $repository;

    /**
     * GetProductAction constructor.
     *
     * @param ProductsRepositoryInterface $repository
     * @param SerializerInterface $serializer
     */
    public function __construct(ProductsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param GetProductResponderInterface $responder
     *
     * @return string
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function __invoke(Request $request, GetProductResponderInterface $responder)
    {
        $data = $this->repository->findProduct($request->attributes->get('id'));
        return $responder->returnResponse(
            $request,
            $data
        );
    }
}
