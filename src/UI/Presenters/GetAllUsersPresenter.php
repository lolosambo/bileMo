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

use App\UI\Presenters\Interfaces\GetAllUsersPresenterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GetAllUsersPresenter
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllUsersPresenter implements GetAllUsersPresenterInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * GetAllUsersPresenter constructor.
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @param $data
     *
     * @return mixed|string
     */
    public function __invoke(
        Request $request,
        $data
    ) {
        return $this->serializer->serialize(
            $data,
            'json',
            ['groups' => [
                'users'
                ]
            ]
        );
    }
}


