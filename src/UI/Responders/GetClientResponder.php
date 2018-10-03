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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @param Request $request
     * @param $data
     *
     * @return Response
     */
    public function returnResponse(
        Request $request,
        $data
    ) {
        $response =  new Response($this->presenter->prepare($data));
        $response->headers->set("Content-Type", "application/json");
        $response->setEtag(md5($response->getContent()));
        $response->setPublic();
        if($response->isNotModified($request)) {
            return $response;
        }
        return $response;
    }
}
