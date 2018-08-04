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
use App\Domain\Repository\Interfaces\ClientsRepositoryInterface;
use App\UI\Presenters\CreateClientPresenter;
use App\UI\Responders\Interfaces\CreateClientResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class CreateClientPresenterTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateClientPresenterTest extends KernelTestCase
{

    private $presenter;

    private $client;

    private $repository;


    /**
     * @throws \Exception
     */
    public function setUp()
    {
        self::bootKernel();
        $serializer = self::$kernel->getContainer()->get('serializer');
        $responder = $this->createMock(CreateClientResponderInterface::class);
        $this->repository = $this->createMock(ClientsRepositoryInterface::class);

        $this->presenter = new CreateClientPresenter($serializer, $this->repository, $responder);

        $client = [];
        $client["username"] = "Client 125";
        $client["password"] = "somePassword";
        $client["mail"] = "test@mail.com";
        $this->client = json_encode($client);
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(CreateClientPresenter::class, $this->presenter);
    }
}

