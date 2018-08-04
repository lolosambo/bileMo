<?php

/*
 * This file is part of the BileMo project.
 *
 * (c) Laurent BERTON <lolosambo2@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\Request\Handlers;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GetAllProductsHandler.
 *
 */
class GetAllProductsHandler
{

    /**
     * @param Request $request
     *
     * @return Request
     */
    public function handle(Request $request, array $options = []): Request
    {
        return $request;
    }

    /**
     * @param Request $request
     */
    public function validate(Request $request, OptionsResolver $resolver): void
    {
        $resolver->setAllowedValues($request->getMethod(), 'GET');
        $resolver->setAllowedValues($request->getUri(), '/show_all_products');
        $request->attributes->set('valid', true);
    }
}
