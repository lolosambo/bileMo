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

namespace App\UI\Responders\Interfaces;

use App\Domain\Models\Interfaces\ClientsInterface;
use Symfony\Component\HttpFoundation\Response;
use App\UI\Presenters\Interfaces\LoginPresenterInterface;

/**
 * Interface LoginResponderInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface LoginResponderInterface
{
    /**
     * LoginResponderInterface constructor.
     * @param LoginPresenterInterface $presenter
     */
    public function __construct(LoginPresenterInterface $presenter);

    /**
     * @param ClientsInterface $client
     *
     * @return mixed
     */
    public function __invoke(ClientsInterface $client);
}
