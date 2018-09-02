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

use App\Domain\Models\Interfaces\ClientsInterface;
use App\Domain\Models\Clients;
use App\UI\Presenters\GetClientPresenter;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GetClientPresenterTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetClientPresenterTest extends KernelTestCase
{

    private $presenter;

    private $client;


    /**
     * @throws \Exception
     */
    public function setUp()
    {
        self::bootKernel();
        $serializer= self::$kernel->getContainer()->get('serializer');
        $this->presenter = new GetClientPresenter($serializer);

        $this->client = new Clients(
            'Client1',
            'SomePassword',
            'test@email.com'
        );
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(GetClientPresenter::class, $this->presenter);
    }

    /**
     * @group unit
     */
    public function testInvoke()
    {
        $request = $this->createMock(Request::class);
        $presenter = $this->presenter;
        $result = $presenter($request, $this->client);
        static::assertInstanceOf(ClientsInterface::class, $this->client);
        static::assertInternalType('string', $result);
    }
}