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

/**
 * Class RequestHandlerFactory
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
final class RequestHandlerFactory
{
    public static function createFromRequest(
        string $path,
        string $routeName
    ) {
        $requestHandler = 'App\Application\Request\Handlers\\' . ucfirst($routeName).'Handler';
        $class = new $requestHandler();
        if(!$class) {
            throw new \Exception('Le RequestHandler demandé n\'existe pas.');
        }
        return $class;
    }
}
