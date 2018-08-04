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

use App\UI\Presenters\Interfaces\GetAllProductsPresenterInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class GetAllProductsPresenter
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class GetAllProductsPresenter implements GetAllProductsPresenterInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * HomePresenter constructor.
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
     * @return \Closure|mixed
     */
    public function __invoke($data)
    {
        return $this->serializer->serialize($data, 'json', ['groups' => ['products']]);
    }
};
