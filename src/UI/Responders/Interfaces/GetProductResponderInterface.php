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

use App\UI\Presenters\Interfaces\GetProductPresenterInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface GetProductResponderInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface GetProductResponderInterface
{

    /**
     * GetProductResponderInterface constructor.
     *
     * @param GetProductPresenterInterface $presenter
     */
    public function __construct(GetProductPresenterInterface $presenter);

    /**
     * @param Request $request
     * @param $data
     *
     * @return string
     */
    public function returnResponse(
        Request $request,
        $data
    );
}
