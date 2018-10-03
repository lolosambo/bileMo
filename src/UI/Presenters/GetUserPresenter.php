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

use App\UI\Presenters\Interfaces\GetUserPresenterInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GetUserPresenter
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetUserPresenter implements GetUserPresenterInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * GetUserPresenter constructor.
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param $data
     *
     * @return string
     */
    public function prepare($data)
    {
        return $this->serializer->serialize($data, 'json', ['groups' => ['user']]);
    }
}
