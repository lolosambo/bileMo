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

namespace App\UI\Presenters;

use App\UI\Presenters\Interfaces\CreateUserPresenterInterface;
use App\UI\Responders\Interfaces\CreateUserResponderInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CreateUserPresenter
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateUserPresenter implements CreateUserPresenterInterface
{
    /**
     * @var CreateUserResponderInterface
     */
    private $responder;

    /**
     * CreateUserPresenter constructor.
     *
     * @param CreateUserResponderInterface $responder
     */
    public function __construct(CreateUserResponderInterface $responder)
    {
        $this->responder = $responder;
    }

    /**
     * @return mixed|Response
     *
     * @throws \Exception
     */
    public function __invoke()
    {
        $responder = $this->responder;
        return $responder();
    }
}
