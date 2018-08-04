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

use App\UI\Presenters\Interfaces\CreateClientPresenterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Laurent BERTON <lolosambo2@gmail.com>
 *
 * Class CreateClientAction
 *
 * @Route(path="/create_client", name="createClient", methods={"POST"})
 */
Interface CreateClientActionInterface
{
    /**
     * @param Request $request
     * @param CreateClientPresenterInterface $presenter
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function __invoke(Request $request, CreateClientPresenterInterface $presenter);
}



