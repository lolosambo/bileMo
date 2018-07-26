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

namespace App\Domain\Repository;

use App\Domain\Models\Interfaces\ProductsInterface;
use App\Domain\Models\Products;
use App\Domain\Repository\Interfaces\ProductsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Ramsey\Uuid\UuidInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ProductsRepository.
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class ProductsRepository extends ServiceEntityRepository implements ProductsRepositoryInterface
{
    /**
     * ProductsRepository constructor.
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Products::class);
    }

    /**
     * @param UuidInterface $productId
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findProduct(UuidInterface $productId)
    {
        return $this->createQueryBuilder('p')
            ->where('p.id = ?1')
            ->setParameter(1, $productId)
            ->setCacheable(true)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $productname
     *
     * @return mixed
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByProductName(string $productName)
    {
        return $this->createQueryBuilder('p')
            ->where('p.name = :productName')
            ->setParameter('productName', $productName)
            ->setCacheable(true)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $brand
     *
     * @return mixed
     */
    public function findOneByBrand(string $brand)
    {
        return $this->createQueryBuilder('p')
            ->Where('p.brand = :brand')
            ->setParameter('brand', $brand)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return mixed
     */
    public function findAllProducts()
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param ProductsInterface $productId
     * @return mixed
     */
    public function deleteProduct(ProductsInterface $productId)
    {
        return $this->createQueryBuilder('p')
            ->delete()
            ->where('p.id = ?1')
            ->setParameter(1, $productId)
            ->getQuery()
            ->execute();
    }

    /**
     * @param ProductsInterface $product
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(ProductsInterface $product)
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush()
    {
        $this->getEntityManager()->flush();
    }
}
