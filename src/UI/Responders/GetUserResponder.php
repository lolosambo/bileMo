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

use App\UI\Responders\Interfaces\GetUserResponderInterface;
use App\UI\Presenters\Interfaces\GetUserPresenterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class GetUserResponder
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetUserResponder implements GetUserResponderInterface
{
    /**
     * @var GetUserPresenterInterface
     */
    private $presenter;

    /**
     * GetUserResponder constructor.
     *
     * @param GetUserPresenterInterface $presenter
     */
    public function __construct(GetUserPresenterInterface $presenter)
    {
        $this->presenter = $presenter;
    }

    /**
     * @param $data
     *
     * @return JsonResponse
     */
    public function __invoke($data)
    {
        $presenter = $this->presenter;
        return new JsonResponse($presenter($data));
    }
}
