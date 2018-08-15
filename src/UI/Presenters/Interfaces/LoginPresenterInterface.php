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

use App\Domain\Models\Interfaces\ClientsInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Interface LoginPresenterInterface
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
Interface LoginPresenterInterface
{
    /**
     * LoginPresenterInterface constructor.
     *
     * @param SerializerInterface $serializer
     * @param JWTEncoderInterface $encoder
     */
    public function __construct(
        SerializerInterface $serializer,
        JWTEncoderInterface $encoder
    );

    /**
     * @param ClientsInterface $client
     *
     * @return mixed
     */
    public function __invoke(ClientsInterface $client);
}
