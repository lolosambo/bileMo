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
namespace App\Domain\DataFixtures\ORM;

use App\Domain\Models\Clients;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
/**
 * Class ClientsFixtures
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class ClientsFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $clientName = 'Client'.$i;
            $password = sha1('MySuperPassword');
            $mail = 'emailforclient'.$i.'@provider.com';
            $client = new Clients($clientName, $password, $mail);
            $client->setInscriptionDate(new \DateTime('+'. mt_rand(2, 100) .' days'));
            $this->addReference('client'.$i, $client);
            $manager->persist($client);
        }
        $manager->flush();
    }
}