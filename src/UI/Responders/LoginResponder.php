<?php

declare(strict_types=1);

/*
 * This file is part of the  project.
 *
 * (c) Laurent BERTON <lolosambo2@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Responders;

use App\Domain\Models\Interfaces\ClientsInterface;
use App\UI\Responders\Interfaces\LoginResponderInterface;
use Symfony\Component\HttpFoundation\Response;
use App\UI\Presenters\Interfaces\LoginPresenterInterface;

/**
 * Class LoginResponder
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class LoginResponder implements LoginResponderInterface
{
    private $presenter;

    /**
     * LoginResponder constructor.
     * @param LoginPresenterInterface $presenter
     */
    public function __construct(LoginPresenterInterface $presenter)
    {
        $this->presenter = $presenter;
    }

    /**
     * @param ClientsInterface $client
     *
     * @return Response
     */
    public function __invoke(ClientsInterface $client)
    {
        $presenter = $this->presenter;
        $response =  new Response($presenter($client));
        $response->headers->set("Content-Type", "application/json");
        return $response;
    }

}