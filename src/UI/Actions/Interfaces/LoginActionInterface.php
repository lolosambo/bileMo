<?php

declare(strict_types=1);

/*
 * This file is part of the  project.
 *
 * (c) Laurent BERTON <lolosambo2@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\UI\Actions\Interfaces;

use App\Domain\Repository\Interfaces\ClientsRepositoryInterface;
use App\UI\Responders\Interfaces\LoginResponderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Interface LoginActionInterface.
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 *
 * @Route(
 *     path="/api/login",
 *     name="login",
 *     methods={"POST"}
 * )
 */
Interface LoginActionInterface
{
    /**
     * LoginAction constructor.
     *
     * @param ClientsRepositoryInterface $repository
     * @param LoginResponderInterface $responder
     */
    public function __construct(
        ClientsRepositoryInterface $repository,
        LoginResponderInterface $responder
    );

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     */
    public function __invoke(Request $request);
}