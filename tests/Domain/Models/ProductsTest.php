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

namespace Tests\Domain\Models;

use App\Domain\Models\Products;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\UuidInterface;

/**
 * Class ProductsTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class ProductsTest extends TestCase
{
    private $product;

    /**
     * @throws \Exception
     */
    public function setUp()
    {
        $product = new Products(
            "galaxy S9+",
            "samsung",
            "Test of the phone's description",
            950.50
        );
        $this->product = $product;
        $this->product->setWeight(250);
        $this->product->setHeight(953);
        $this->product->setWidth(405);
        $this->product->setScreen('9 pouces');
        $this->product->setOs('androïd Lollipop');
    }

    /**
     * @group unit
     */
    public function testUsersConstruct()
    {
        static::assertInstanceof(Products::class, $this->product);
    }

    /**
     * @group unit
     */
    public function testProductAttributes()
    {
        static::assertObjectHasAttribute('id', $this->product);
        static::assertObjectHasAttribute('name', $this->product);
        static::assertObjectHasAttribute('brand', $this->product);
        static::assertObjectHasAttribute('description', $this->product);
        static::assertObjectHasAttribute('height', $this->product);
        static::assertObjectHasAttribute('width', $this->product);
        static::assertObjectHasAttribute('weight', $this->product);
        static::assertObjectHasAttribute('os', $this->product);
        static::assertObjectHasAttribute('screen', $this->product);
        static::assertObjectHasAttribute('price', $this->product);
    }

    /**
     * @group unit
     */
    public function testProductMustHaveValidAttributes()
    {
        static::assertInstanceOf(UuidInterface::class, $this->product->getId());
        static::assertInternalType('string', $this->product->getName());
        static::assertInternalType('string', $this->product->getBrand());
        static::assertInternalType('string', $this->product->getDescription());
        static::assertInternalType('int', $this->product->getHeight());
        static::assertInternalType('int', $this->product->getWidth());
        static::assertInternalType('int', $this->product->getWeight());
        static::assertInternalType('string', $this->product->getOs());
        static::assertInternalType('string', $this->product->getScreen());
        static::assertInternalType('float', $this->product->getPrice());

    }

    /**
     * @group unit
     */
    public function testProductEntityHydratation()
    {
        static::assertContains('galaxy S9+', $this->product->getName());
        static::assertContains('samsung', $this->product->getBrand());
        static::assertContains('Test of the phone\'s description', $this->product->getDescription());
        static::assertEquals(953, $this->product->getHeight());
        static::assertEquals(405, $this->product->getWidth());
        static::assertEquals(250, $this->product->getWeight());
        static::assertContains('Androïd Lollipop', $this->product->getOs());
        static::assertContains('9 pouces', $this->product->getScreen());
        static::assertEquals(950.50, $this->product->getPrice());

    }
}







