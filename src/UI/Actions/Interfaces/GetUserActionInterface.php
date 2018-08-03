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

use App\UI\Responders\Interfaces\GetUserResponderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface GetUserActionInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface GetUserActionInterface
{
    /**
     * @param Request $request
     * @param GetUserResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(Request $request, GetUserResponderInterface $responder);

}

