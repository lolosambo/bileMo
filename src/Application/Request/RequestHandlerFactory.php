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

namespace App\Application\Request;

use App\Application\Request\Interfaces\RequestHandlerFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestHandlerFactory
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
final class RequestHandlerFactory implements RequestHandlerFactoryInterface
{
    /**
     * @param string $path
     * @param string $routeName
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public static function createFromRequest(Request $request)
    {
        $handler = $request->attributes->get('_request_handler');
        if (!\is_string($handler)) { return null; }
        $class = new $handler($request);
        if($class::ROUTE == $request->attributes->get('_route') && (\in_array($request->getMethod(), $class::METHODS))) {
            return $class;
        }
        throw new \Exception('No matching route found or bad methods used !');
    }
}
