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

use App\Domain\Models\Clients;
use App\Domain\Models\Interfaces\ClientsInterface;
use App\Domain\Repository\Interfaces\ClientsRepositoryInterface;
use App\UI\Presenters\Interfaces\CreateClientPresenterInterface;
use App\UI\Responders\Interfaces\CreateClientResponderInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class CreateClientPresenter
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateClientPresenter implements CreateClientPresenterInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var ClientsRepositoryInterface
     */
    private $repository;

    /**
     * @var CreateClientResponderInterface
     */
    private $responder;

    /**
     * CreateClientPresenter constructor.
     *
     * @param SerializerInterface $serializer
     * @param ClientsRepositoryInterface $repository
     * @param CreateClientResponderInterface $responder
     */
    public function __construct(
        SerializerInterface $serializer,
        ClientsRepositoryInterface $repository,
        CreateClientResponderInterface $responder
    ) {
        $this->serializer = $serializer;
        $this->repository = $repository;
        $this->responder = $responder;
    }

    /**
     * @param $data
     *
     * @return mixed|\Symfony\Component\HttpFoundation\Response
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     */
    public function __invoke($data)
    {
        $client = $this->serializer->deserialize(
            $data,
            Clients::class,
            'json'
        );
        $this->repository->save($client);
        $responder = $this->responder;
        if($this->repository->findOneByClientName($client->getUsername())) {
            return $responder();
        } else {
            throw new \Exception('Il y a eu un problème lors de l\'enregistrement du client en base de données');
        }
    }
}
