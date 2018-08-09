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

namespace App\Application\Request\Handlers\Interfaces;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Interface CreateUserInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
interface CreateUserHandlerInterface
{
    /**
     * @param Request $request
     *
     * @return Request
     */
    public function handle(Request $request): Request;

    /**
     * @param Request $request
     */
    public function configureOptions(OptionsResolver $resolver): void;
}