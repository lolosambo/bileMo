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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class ClientsFixtures
 *
 * @author Laurent BERTON <lolosambo2@gmail.com>
 */
class ClientsFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * ClientsFixtures constructor.
     *
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    /**
     * @param ObjectManager $manager
     *
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10; $i++) {
            $clientName = 'Client'.$i;
            $password = 'MySuperPassword';
            $mail = 'emailforclient'.$i.'@provider.com';
            $client = new Clients($clientName, $password, $mail);
            $encoded_password = $this->encoder->encodePassword($client, $password);
            $client->setPassword($encoded_password);
            $client->setInscriptionDate(new \DateTime('+'. mt_rand(2, 100) .' days'));
            $this->addReference('client'.$i, $client);
            $manager->persist($client);
        }
        $manager->flush();
    }
}