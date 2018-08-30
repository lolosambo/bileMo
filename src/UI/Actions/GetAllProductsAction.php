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
use App\UI\Actions\Interfaces\GetAllProductsActionInterface;
use App\UI\Responders\Interfaces\GetAllProductsResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 *  * @author Laurent BERTON <lolosambo2@gmail.com>
 *
 * Class GetAllProductsAction
 *
 * @Route(
 *     name="getAllProducts",
 *     path="/products",
 *     methods={"GET"},
 *     defaults={
 *         "_request_handler": "App\Application\Request\Handlers\GetAllProductsHandler"
 *     }
 * )
 */
class GetAllProductsAction implements GetAllProductsActionInterface
{
    /**
     * @var ProductsRepositoryInterface
     */
    private $repository;

    /**
     * HomeAction constructor.
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
     * @param GetAllProductsResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        GetAllProductsResponderInterface $responder
    ) {
        $data = $this->repository->findAllProducts();
        return $responder($request, $data);
    }

}

