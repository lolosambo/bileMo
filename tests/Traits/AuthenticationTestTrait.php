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
namespace Tests\Traits;

Trait AuthenticationTestTrait
{
    public function authenticate(
        string $username,
        string $password
    ) {

        $client = static::createClient();
        $client->request(
            "POST",
            "/api/login_check",
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json'
            ],
            json_encode([
                "username" => $username,
                "password" => $password
            ])
        );
        $token = json_decode($client->getResponse()->getContent(), true);

        if(!isset($token['token'])){
            return $client;
        } else {
            $client->setServerParameter(
                'HTTP_Authorization',
                sprintf(
                    'Bearer %s',
                    $token['token']
                )
            );
            return $client;
        }
    }
}