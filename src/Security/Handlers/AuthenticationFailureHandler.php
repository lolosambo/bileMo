<?php

declare(strict_types=1);

/*
 * This file is part of the BileMo project.
 *
 * (c) Laurent BERTON <lolosambo2@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Security\Handlers;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authentication\AuthenticationFailureHandlerInterface;

/**
 * Class AuthenticationFailureHandler
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class AuthenticationFailureHandler implements AuthenticationFailureHandlerInterface
{
    /**
     * @param Request $request
     * @param AuthenticationException $exception
     *
     * @return JsonResponse|Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            'message' => strtr(
                $exception->getMessageKey(),
                $exception->getMessageData()
            )
        ];
        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }
}