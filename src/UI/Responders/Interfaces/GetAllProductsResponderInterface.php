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

use App\UI\Presenters\Interfaces\GetAllProductsPresenterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Interface GetAllProductsResponderInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface GetAllProductsResponderInterface
{

    /**
     * GetAllProductsResponderInterface constructor.
     *
     * @param GetAllProductsPresenterInterface $presenter
     */
    public function __construct(GetAllProductsPresenterInterface $presenter);

    /**
     * @param $data
     *
     * @return JsonResponse
     */
    public function __invoke($data);

}
