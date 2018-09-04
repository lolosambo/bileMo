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
use Behat\Mink\Exception\ExpectationException;
use Behat\MinkExtension\Context\MinkContext;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * This context class contains the definitions of the steps used by the demo 
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 * 
 * @see http://behat.org/en/latest/quick_start.html
 */
class FeatureContext extends MinkContext
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var EntityManagerInterface $em
     */
    private $em;

    /**
     * FeatureContext constructor.
     *
     * @param EntityManagerInterface $em
     * @param KernelInterface $kernel
     */
    public function __construct(
        EntityManagerInterface $em,
        KernelInterface $kernel
    ) {
        $this->kernel = $kernel;
        $this->em = $em;
    }

    /**
     * @param $identifier
     *
     * @Then Client :identifier should exists into Database
     *
     * @throws ExpectationException
     */
    public function clientShouldExistsIntoDatabase($identifier)
    {
        $client = $this->em->getRepository(Clients::class)->FindOneByClientName($identifier);
        if(!$client) {
            throw new ExpectationException(
                sprintf('Client with identifier $s should exists', $identifier),
                $this->getSession()->getDriver());
        }
    }

}
