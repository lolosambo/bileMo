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

namespace App\Domain\Repository\Interfaces;

use App\Domain\Models\Interfaces\ProductsInterface;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Interface ProductsRepositoryInterface.
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface ProductsRepositoryInterface
{
    /**
     * ProductsRepositoryInterface constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry);

    /**
     * @param string $productId
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findProduct(string $productId);

    /**
     * @param string $productname
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByProductName(string $productName);

    /**
     * @param string $brand
     *
     * @return mixed
     */
    public function findOneByBrand(string $brand);

    /**
     * @return mixed
     */
    public function findAllProducts();

    /**
     * @param ProductsInterface $productId
     * @return mixed
     */
    public function deleteProduct(ProductsInterface $productId);

    /**
     * @param ProductsInterface $product
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(ProductsInterface $product);

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush();
}