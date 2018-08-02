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

use App\UI\Responders\Interfaces\GetAllClientsResponderInterface;
use App\UI\Presenters\Interfaces\GetAllClientsPresenterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class GetAllClientsResponder
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllClientsResponder implements GetAllClientsResponderInterface
{
    /**
     * @var GetAllClientsPresenterInterface
     */
    private $presenter;

    /**
     * GetAllClientsResponder constructor.
     *
     * @param GetAllClientsPresenterInterface $presenter
     */
    public function __construct(GetAllClientsPresenterInterface $presenter)
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
