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

use App\Domain\Models\Clients;

trait AuthenticationTestTrait
{
    /**
     * @param string $username
     * @param string $password
     *
     * @return string
     *
     * @throws \Exception
     */
    public function authenticate(
        string $username,
        string $password
    ): string {
        $client = new Clients($username, $password, '');
        static::bootKernel();
        return static::$kernel->getContainer()->get('lexik_jwt_authentication.jwt_manager')->create($client);
    }
}