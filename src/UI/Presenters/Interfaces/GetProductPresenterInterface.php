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

/**
 * Interface GetProductPresenterInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface GetProductPresenterInterface
{
    /**
     * @param $data
     *
     * @return mixed
     */
    public function __invoke($data);
}
