<?php

declare(strict_types=1);

/*
 * This file is part of the BileMo project.
 *
 * (c) Laurent BERTON <lolosambo2@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Security\Handlers;

use App\Domain\Repository\Interfaces\ClientsRepositoryInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

/**
 * Class AuthenticationSuccessHandler
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class AuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{

    /**
     * @var JWTEncoderInterface
     */
    private $jwtEncoder;

    /**
     * @var ClientsRepositoryInterface
     */
    private $repository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passEncoder;

    public function __construct (
        JWTEncoderInterface $jwtEncoder,
        ClientsRepositoryInterface $repository,
        UserPasswordEncoderInterface $passEncoder
    ) {
        $this->encoder = $jwtEncoder;
        $this->repository = $repository;
        $this->passEncoder = $passEncoder;
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     *
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        dump($request); die;
        $username = $request->attributes->get('username');
        $password = $request->attributes->get('password');
        $client = $this->repository->findOneByClientName($username);
        if($this->passEncoder->isPasswordValid($client, $password)) {
            $token = $this->jwtEncoder->encode(['username' => $client->getUsername()]);
            return new JsonResponse(['token' => $token]);
        }
        return;
    }

}