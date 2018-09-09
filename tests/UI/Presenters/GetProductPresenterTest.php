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

namespace Tests\UI\Presenters;

use App\Domain\Models\Interfaces\ProductsInterface;
use App\Domain\Models\Products;
use App\UI\Presenters\GetProductPresenter;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GetProductPresenterTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetProductPresenterTest extends KernelTestCase
{

    private $presenter;

    private $product;


    /**
     * @throws \Exception
     */
    public function setUp()
    {
        self::bootKernel();
        $serializer= self::$kernel->getContainer()->get('serializer');
        $this->presenter = new GetProductPresenter($serializer);

        $this->product = new Products(
            'Product1',
            'Apple',
            'Some product description',
            950.99
        );
        $this->product->setHeight(850);
        $this->product->setWidth(250);
        $this->product->setWeight(200);
        $this->product->setScreen('6 pouces');
        $this->product->setOs('IOS 12');
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetProductPresenter::class, $this->presenter);
    }

    /**
     * @group unit
     */
    public function testInvoke()
    {
        $result = $this->presenter->prepare($this->product);
        static::assertInstanceOf(ProductsInterface::class, $this->product);
        static::assertInternalType('string', $result);
    }
}