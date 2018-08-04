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

namespace App\UI\Responders;

use App\UI\Responders\Interfaces\CreateClientResponderInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CreateClientResponder
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateClientResponder implements CreateClientResponderInterface
{
    /**
     * @return Response
     */
    public function __invoke()
    {
        return new Response('Le client a bien été ajouté à la base de données', Response::HTTP_CREATED);
    }
}
