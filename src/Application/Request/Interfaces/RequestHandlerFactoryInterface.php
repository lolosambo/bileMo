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

namespace App\Application\Request\Interfaces;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class RequestHandlerFactoryInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface RequestHandlerFactoryInterface
{
    /**
     * @param string $path
     * @param string $routeName
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public static function createFromRequest(Request $request);
}