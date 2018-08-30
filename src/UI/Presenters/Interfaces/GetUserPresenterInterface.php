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

namespace App\UI\Presenters\Interfaces;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface GetUserPresenterInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface GetUserPresenterInterface
{
    /**
     * @param Request $request
     * @param $data
     *
     * @return mixed
     */
    public function __invoke(
        Request $request,
        $data
    );
}
