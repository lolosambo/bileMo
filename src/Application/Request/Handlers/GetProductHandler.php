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

use App\Application\Request\Handlers\Interfaces\GetProductHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class GetProductHandler.
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetProductHandler implements GetProductHandlerInterface
{
    const ROUTE = "getProduct";
    const METHODS = ['GET'];
    /**
     * @var Request
     */
    private $request;

    /**
     * @var
     */
    private $options;

    /**
     * @param Request $request
     *
     * @return Request
     */
    public function handle(Request $request): Request
    {
        $this->request = $request;
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);
        $this->options = $resolver->resolve($request->attributes->all());
        return $request;
    }

    /**
     * @param Request $request
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
                "_request_handler" => "App\Application\Request\Handlers\GetProductHandler",
                "_controller" => "App\UI\Actions\GetProductAction",
                "_route" => "getProduct",
                "_firewall_context" =>"security.firewall.map.context.main",
                "_route_params" => [],
                "id" => $this->request->attributes->get('id'),
                "valid" => false
            ]
        );
        $this->request->attributes->set('valid', true);
    }
}

