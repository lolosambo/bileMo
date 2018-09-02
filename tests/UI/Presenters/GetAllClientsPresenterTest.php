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

use App\UI\Presenters\GetAllClientsPresenter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GetAllClientsPresenterTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllClientsPresenterTest extends KernelTestCase
{

    private $presenter;

    public function setUp()
    {
        self::bootKernel();
        $serializer= self::$kernel->getContainer()->get('serializer');
        $this->presenter = new GetAllClientsPresenter($serializer);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetAllClientsPresenter::class, $this->presenter);
    }

    /**
     * @group unit
     */
    public function testInvoke()
    {
        $request = $this->createMock(Request::class);
        $data = ['data1', 'data2', 'data3'];
        $presenter = $this->presenter;
        $result = $presenter($request, $data);
        static::assertInternalType('string', $result);
    }
}
