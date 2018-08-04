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

namespace App\Application\Subscribers;

use App\Application\Request\RequestHandlerFactory;
use App\Application\Subscribers\Interfaces\RequestSubscriberInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class RequestSubscriber
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class RequestSubscriber implements EventSubscriberInterface, RequestSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST=>['onKernelRequest']
        );
    }

    /**
     * @param GetResponseEvent $event
     *
     * @throws \Exception
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $path = $event->getRequest()->getUri();
        $routeName = $event->getRequest()->attributes->get('_route');
        if(!$path || !$routeName ) {
            throw new \Exception('The required RequestHandler doesn\'t exists. Missing path or Route name');
        }
        $requestHandler = RequestHandlerFactory::createFromRequest(
            $event->getRequest()->getUri(),
            $event->getRequest()->attributes->get('_route')
        );
        $requestHandler->handle($event->getRequest());
    }
}
