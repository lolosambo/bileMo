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

namespace App\UI\Responders;

use App\UI\Presenters\Interfaces\CreateUserPresenterInterface;
use App\UI\Responders\Interfaces\CreateUserResponderInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CreateUserResponder
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateUserResponder implements CreateUserResponderInterface
{
    /**
     * @var CreateUserPresenterInterface
     */
    private $presenter;

    /**
     * CreateUserResponder constructor.
     *
     * @param CreateUserPresenterInterface $presenter
     */
    public function __construct(CreateUserPresenterInterface $presenter)
    {
        $this->presenter = $presenter;
    }
    /**
     * @return Response
     */
    public function returnResponse(): Response
    {
        return new Response($this->presenter->prepare(), Response::HTTP_CREATED);
    }
}

