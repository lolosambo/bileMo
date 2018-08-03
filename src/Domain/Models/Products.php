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

namespace App\Domain\Models;

use App\Domain\Models\Interfaces\ProductsInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * Class Products
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class Products implements ProductsInterface
{
    /**
     * @var UuidInterface
     *
     * @Groups ({"products"})
     */
    private $id;

    /**
     * @var string $name
     *
     * @Groups ({"products", "product"})
     */
    private $name;

    /**
     * @var string $brand
     *
     * @Groups ({"products", "product"})
     */
    private $brand;

    /**
     * @var string $description
     *
     * @Groups ({"product"})
     */
    private $description;

    /**
     * @var int $height
     *
     * @Groups ({"product"})
     */
    private $height;

    /**
     * @var int $width
     *
     * @Groups ({"product"})
     */
    private $width;

    /**
     * @var int $weight
     *
     * @Groups ({"product"})
     */
    private $weight;

    /**
     * @var string $screen
     *
     * @Groups ({"product"})
     */
    private $screen;

    /**
     * @var string $os
     *
     * @Groups ({"product"})
     */
    private $os;

    /**
     * @var float $price
     *
     * @Groups ({"products", "product"})
     */
    private $price;

    /**
     * Products constructor.
     *
     * @param string $name
     * @param string $brand
     * @param string $description
     * @param float $price
     *
     * @throws \Exception
     */
    public function __construct(
        string $name,
        string $brand,
        string $description,
        float $price
    ) {
        $this->id = Uuid::uuid4();
        $this->name = $name;
        $this->brand = $brand;
        $this->description = $description;
        $this->price = $price;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = ucfirst($name);
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = ucfirst($brand);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * @param int $weight
     */
    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return string
     */
    public function getScreen(): string
    {
        return $this->screen;
    }

    /**
     * @param string $screen
     */
    public function setScreen(string $screen): void
    {
        $this->screen = $screen;
    }

    /**
     * @return string
     */
    public function getOs(): string
    {
        return $this->os;
    }

    /**
     * @param string $os
     */
    public function setOs(string $os): void
    {
        $this->os = ucfirst($os);
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->name,
            $this->brand,
            $this->height,
            $this->width,
            $this->weight,
            $this->screen,
            $this->os,
            $this->price
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->name,
            $this->brand,
            $this->height,
            $this->width,
            $this->weight,
            $this->screen,
            $this->os,
            $this->price
            ) = unserialize($serialized);
    }
}


