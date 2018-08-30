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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @param Request $request
     * @param $data
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse|Response
     */
    public function __invoke(
        Request $request,
        $data
    ) {
        $presenter = $this->presenter;
        $response =  new Response($presenter($request, $data));
        $response->headers->set("Content-Type", "application/json");
        $response->setEtag(md5('Once_Upon_A_Time_Validation_Cache'.rand(10000000, 99999999)));
        $response->setPublic();
        $response->isNotModified($request);
        return $response;
    }
}
