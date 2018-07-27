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

use App\Domain\Models\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
/**
 * Class UsersFixtures
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class UsersFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 50; $i++) {
            $username = 'User' . $i;
            $password = sha1('MySuperPassword');
            $firstName = 'FirstName' . $i;
            $lastName = "LASTNAME" . $i;
            $mail = 'emailforuser' . $i . '@provider.com';
            $user = new Users($username, $password, $firstName, $lastName, $mail);
            $user->setPhone('06 ' . mt_rand(00, 99) . ' ' . mt_rand(00, 99) . ' ' . mt_rand(00, 99) . ' ' . mt_rand(00, 99));
            $user->setInscriptionDate(new \DateTime('+' . mt_rand(2, 100) . ' days'));
            $user->setClient($this->getReference('client' . mt_rand(1, 10)));
            $user->setAddress($this->getReference('address' . mt_rand(1, 100)));
            $this->addReference('user'.$i, $user);
            $manager->persist($user);

            $manager->flush();
        }
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            ClientsFixtures::class,
            AddressesFixtures::class
        ];
    }
}