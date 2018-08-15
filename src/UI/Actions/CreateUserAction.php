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

namespace App\UI\Actions;

use App\UI\Actions\Interfaces\CreateUserActionInterface;
use App\UI\Presenters\Interfaces\CreateUserPresenterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\DecoderInterface;

/**
 * @author Laurent BERTON <lolosambo2@gmail.com>
 *
 * Class CreateUserAction
 *
 * @Route(
 *     path="/user/create",
 *     name="createUser",
 *     methods={"POST"},
 *     defaults={
 *         "_request_handler": "App\Application\Request\Handlers\CreateUserHandler"
 *     }
 * )
 */
class CreateUserAction implements CreateUserActionInterface
{
    /**
     * @var DecoderInterface
     */
    private $decoder;

    /**
     * CreateUserAction constructor.
     *
     * @param DecoderInterface $decoder
     */
    public function __construct(DecoderInterface $decoder)
    {
        $this->decoder = $decoder;
    }
    /**
     * @param Request $request
     * @param CreateUserPresenterInterface $presenter
     *
     * @return mixed|\Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     */
    public function __invoke(Request $request, CreateUserPresenterInterface $presenter)
    {
        $data = $request->getContent();
        $userData = $this->decoder->decode($data, 'json');
        $addressData = $userData['address'];
        unset($userData['address']);
        return $presenter($userData, $addressData);
    }

}

