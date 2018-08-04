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

namespace App\Application\Subscribers\Interfaces;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

/**
 * Class RequestSubscriberInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface RequestSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents();

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event);
}
