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

use App\UI\Responders\Interfaces\GetAllUsersResponderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface GetAllUsersActionInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface GetAllUsersActionInterface
{
    /**
     * @param GetAllUsersResponderInterface $responder
     *
     * @return mixed
     */
    public function __invoke(GetAllUsersResponderInterface $responder);

}

