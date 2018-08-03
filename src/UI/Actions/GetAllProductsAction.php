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
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 *  * @author Laurent BERTON <lolosambo2@gmail.com>
 *
 * Class GetAllProductsAction
 *
 * @Route(name="showAllProducts", path="/show_all_products", methods={"GET"})
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
     * @param GetAllProductsResponderInterface $responder
     *
     * @return mixed|\Symfony\Component\HttpFoundation\JsonResponse
     */
    public function __invoke(GetAllProductsResponderInterface $responder)
    {
        $data = $this->repository->findAllProducts();
        return $responder($data);
    }

}

