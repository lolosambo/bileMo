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
namespace Tests\UI\Actions;

use Blackfire\Bridge\PhpUnit\TestCaseTrait;
use Tests\Traits\AuthenticateTrait;
use Blackfire\Profile\Configuration;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
/**
 * Class CreateUserActionFunctionalTest
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class CreateUserActionFunctionalTest extends WebTestCase
{
//    use TestCaseTrait;
    use AuthenticateTrait;

    /**
     * @group functional
     */
    public function testGetStatusCodeWithoutAuthentication()
    {
        $client = $this->authenticate("BadUsername", "Badpassword");
        $client->request(
            'POST',
            '/users'
        );
        static::assertEquals(Response::HTTP_UNAUTHORIZED, $client->getResponse()->getStatusCode());
    }

//    /**
//     * @group functional
//     */
    public function testGetStatusCodeWithAuthentication()
    {
        $client = $this->authenticate("Client1", "MySuperPassword");
        $client->request(
            'POST',
            '/users',
            [],
            [],
            [
                "CONTENT_TYPE" => "application/json"
            ],
            json_encode([
                "username" => "LolosamboTest",
                "password" => "MySuperPassword",
                "firstName" => "Laurent",
                "lastName" => "BERTON",
                "mail" => "lolosambo2@gmail.com",
                "address" => [
                    "number" => 20,
                    "way" => "allée Baudelaire",
                    "zipCode" => 59139,
                    "region" => "Nord",
                    "country" => "France"
                ],
                "phone" => "02.02.22.33.44"
            ])
        );
        static::assertEquals(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());

    }

}