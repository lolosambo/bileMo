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

use App\UI\Presenters\CreateUserPresenter;
use App\UI\Responders\Interfaces\CreateUserResponderInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class CreateUserPresenterTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateUserPresenterTest extends KernelTestCase
{
    private $responder;

    private $presenter;

    /**
     * @throws \Exception
     */
    public function setUp()
    {
        $this->presenter = new CreateUserPresenter();
    }

    /**
     * @group unit
     */
    public function testConstruct()
    {
        static::assertInstanceOf(CreateUserPresenter::class, $this->presenter);
    }
}

