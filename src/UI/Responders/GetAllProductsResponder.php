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

use App\UI\Responders\Interfaces\GetAllProductsResponderInterface;
use App\UI\Presenters\Interfaces\GetAllProductsPresenterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GetAllProductsResponder
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllProductsResponder implements GetAllProductsResponderInterface
{
    /**
     * @var GetAllProductsPresenterInterface
     */
   private $presenter;

    /**
     * HomeResponder constructor.
     *
     * @param GetAllProductsPresenterInterface $presenter
     */
   public function __construct(GetAllProductsPresenterInterface $presenter)
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

