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

use Behatch\Context\RestContext;

/**
 * Class ApiRestContext
 */
class ApiRestContext extends RestContext
{

    /**
     * @Then the response should be received
     */
    public function theResponseShouldBeReceived()
    {

    }

    /**
     * @When I was authenticated on url :loginUri with method :method as user :username with password :password, I send a :sentRequestMethod request to :requestUri
     */
    public function iWasAuthenticatedOnUrlWithMethodAsUserWithPasswordISendARequestTo(
        $loginUri,
        $method,
        $username,
        $password,
        $sentRequestMethod,
        $requestUri
    ) {
        $requestlogin = $this->request->send(
          $method,
          $this->locatePath($loginUri),
          [],
          [],
          json_encode([
              'username' => $username,
              'password' => $password
          ]),
          ['CONTENT_TYPE' => 'application/json']
        );

        $data = json_decode($requestlogin->getContent(), true);

    }

    /**
     * @Then the JSON node :jsonNode should exist
     */
    public function theJsonNodeShouldExist($jsonNode)
    {

    }


}
