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

use App\Domain\Models\Clients;
use App\Domain\Models\Users;
use Behatch\HttpCall\Request;
use Behatch\Context\RestContext;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

/**
 * Class ApiRestContext
 */
class ApiRestContext extends RestContext
{
    /**
     * @var UserPasswordEncoder
     */
    private $encoder;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ApiRestContext constructor.
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserPasswordEncoder $encoder
     */
    public function __construct(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordEncoder $encoder
    ) {
        parent::__construct($request);
        $this->request = $request;
        $this->em = $em;
        $this->encoder = $encoder;
    }

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

        $data =  json_decode($requestlogin->getContent(), true);

    }

    /**
     * @Given I load :file fixtures file
     *
     * @throws Exception
     */
    public function iLoadFollowingFixturesFile($file)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__.'/../fixtures/'.$file.'.yml');
        foreach($objectSet->getObjects() as $object) {
            if($object instanceof Users) {
                $user = new Users(
                    $object->getUsername(),
                    $this->encoder->encodepassword($object, $object->getpassword()),
                    $object->getFirstName(),
                    $object->getlastname(),
                    $object->getMail()
                );
                $this->em->persist($user);
            } elseif($object instanceof Clients) {
                $client = new Clients(
                    $object->getUsername(),
                    $this->encoder->encodepassword($object, $object->getpassword()),
                    $object->getMail()
                );
                $this->em->persist($client);
            } else {
                $this->em->persist($object);
            }
        }
        $this->em->flush();
    }
}
