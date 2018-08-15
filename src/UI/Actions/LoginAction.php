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

namespace App\UI\Actions;

use App\Domain\Repository\Interfaces\ClientsRepositoryInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;

class LoginAction
{
    private $repository;
    private $passEncoder;
    private $jwtEncoder;


    public function __construct(ClientsRepositoryInterface $repository, UserPasswordEncoderInterface $passEncoder, JWTEncoderInterface $jwtEncoder)
    {
        $this->repository = $repository;
        $this->passEncoder = $passEncoder;
        $this->jwtEncoder = $jwtEncoder;
    }

    /**

     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {

    }
}
