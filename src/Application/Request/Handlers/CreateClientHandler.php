<?php

/*
 * This file is part of the BileMo project.
 *
 * (c) Laurent BERTON <lolosambo2@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\Request\Handlers;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class CreateClientHandler.
 *
 */
class CreateClientHandler
{

    /**
     * @param Request $request
     *
     * @return Request
     */
    public function handle(Request $request): Request
    {
        return $request;
    }

    /**
     * @param Request $request
     */
    public function validate(Request $request): void
    {
//        ....
        $request->attributes->set('valid', true);
    }
}
