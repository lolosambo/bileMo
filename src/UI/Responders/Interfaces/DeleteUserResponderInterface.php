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

namespace App\UI\Responders\Interfaces;

use Symfony\Component\HttpFoundation\Response;

/**
 * Interface DeleteUserResponderInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
interface DeleteUserResponderInterface
{
    /**
     * @return Response
     */
    public function returnResponse(): Response;
}
