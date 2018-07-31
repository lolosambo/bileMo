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

use App\UI\Presenters\GetAllProductsPresenter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GetAllProductsPresenterTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllProductsPresenterTest extends TestCase
{

    private $presenter;

    public function setUp()
    {
        $serializer = $this->createMock(SerializerInterface::class);
        $this->presenter = new GetAllProductsPresenter($serializer);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetAllProductsPresenter::class, $this->presenter);
    }

    /**
     * @group unit
     */
    public function testInvoke()
    {
        $data = ['data1', 'data2', 'data3'];
        $presenter = $this->presenter;
        $result = $presenter($data);
        static::assertInternalType('array', $result);
    }
}