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

namespace App\UI\Actions\Interfaces;

use App\UI\Responders\Interfaces\GetProductResponderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface GetProductActionInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface GetProductActionInterface
{
    /**
     * @param Request $request
     * @param GetProductResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(Request $request, GetProductResponderInterface $responder);

}

