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

namespace App\Domain\Models\Interfaces;

use Ramsey\Uuid\UuidInterface;

/**
 * Class ProductsInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface ProductsInterface
{
    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;

    /**
     * @return string
     */
    public function getBrand(): string;

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void;

    /**
     * @return string
     */
    public function getDescription(): string;

    /**
     * @param string $description
     */
    public function setDescription(string $description): void;

    /**
     * @return int
     */
    public function getHeight(): int;

    /**
     * @param int $height
     */
    public function setHeight(int $height): void;

    /**
     * @return int
     */
    public function getWidth(): int;

    /**
     * @param int $width
     */
    public function setWidth(int $width): void;

    /**
     * @return int
     */
    public function getWeight(): int;

    /**
     * @param int $weight
     */
    public function setWeight(int $weight): void;

    /**
     * @return string
     */
    public function getScreen(): string;

    /**
     * @param string $screen
     */
    public function setScreen(string $screen): void;

    /**
     * @return string
     */
    public function getOs(): string;

    /**
     * @param string $os
     */
    public function setOs(string $os): void;

    /**
     * @return float
     */
    public function getPrice(): float;

    /**
     * @param float $price
     */
    public function setPrice(float $price): void;

    /** @see \Serializable::serialize() */
    public function serialize();

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized);
}