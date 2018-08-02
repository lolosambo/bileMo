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

use App\UI\Responders\Interfaces\GetClientResponderInterface;
use App\UI\Presenters\Interfaces\GetClientPresenterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class GetClientResponder
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetClientResponder implements GetClientResponderInterface
{
    /**
     * @var GetClientPresenterInterface
     */
    private $presenter;

    /**
     * GetClientResponder constructor.
     *
     * @param GetClientPresenterInterface $presenter
     */
    public function __construct(GetClientPresenterInterface $presenter)
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