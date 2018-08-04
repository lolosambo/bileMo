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

namespace App\UI\Presenters\Interfaces;

use App\Domain\Repository\Interfaces\ClientsRepositoryInterface;
use App\UI\Responders\Interfaces\CreateClientResponderInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Interface CreateClientPresenterInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface CreateClientPresenterInterface
{
    /**
     * CreateClientPresenterInterface constructor.
     *
     * @param SerializerInterface $serializer
     * @param ClientsRepositoryInterface $repository
     * @param CreateClientResponderInterface $responder
     */
    public function __construct(
        SerializerInterface $serializer,
        ClientsRepositoryInterface $repository,
        CreateClientResponderInterface $responder
    );

    /**
     * @param $data
     *
     * @return mixed
     */
    public function __invoke($data);
}
