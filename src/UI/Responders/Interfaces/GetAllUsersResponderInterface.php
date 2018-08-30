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

use App\UI\Presenters\Interfaces\GetAllUsersPresenterInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Interface GetAllUsersResponderInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface GetAllUsersResponderInterface
{

    /**
     * GetAllUsersResponderInterface constructor.
     *
     * @param GetAllUsersPresenterInterface $presenter
     */
    public function __construct(GetAllUsersPresenterInterface $presenter);

    /**
     * @param $data
     *
     * @return JsonResponse
     */
    public function __invoke(
        Request $request,
        $data
    );

}
