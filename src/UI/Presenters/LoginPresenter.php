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

namespace App\UI\Presenters;

use App\Domain\Models\Interfaces\ClientsInterface;
use App\UI\Presenters\Interfaces\LoginPresenterInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class LoginPresenter
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class LoginPresenter implements LoginPresenterInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    private $tokenEncoder;

    /**
     * LoginPresenter constructor.
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(
        SerializerInterface $serializer,
        JWTEncoderInterface $encoder
    ) {
        $this->serializer = $serializer;
        $this->tokenEncoder = $encoder;
    }

    /**
     * @param ClientsInterface $client
     *
     * @return mixed|string
     *
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function __invoke(ClientsInterface $client)
    {
        $token = $this->tokenEncoder->encode([
            'username' => $client->getUsername(),
            'password' => $client->getPassword()
        ]);
        return new JsonResponse(['token' => $token]);
    }
}
