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

use App\Domain\Models\Addresses;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
/**
 * Class AddressesFixtures
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class AddressesFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 100; $i++) {
            $number = mt_rand(1, 300);
            $way= 'Street name'.$i;
            $zipCode = mt_rand(59000, 59999);
            $city = 'city'.$i;
            $region = 'Region'.$i;
            $country = 'FRANCE';
            $address = new Addresses($number, $way, $zipCode, $city, $region, $country);
            $manager->persist($address);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies()
    {
        return [
            UsersFixtures::class
        ];
    }
}