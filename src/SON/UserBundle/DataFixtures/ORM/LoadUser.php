<?php

namespace SON\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use SON\UserBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUser implements FixtureInterface, ContainerAwareInterface{

    private $container;
    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param Doctrine\Common\Persistence\ObjectManager $manager
     */
    function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('user')
            ->setPassword($this->encodePassword($user,'user'))
            ->setIsActive(true)
            ->setEmail('user@son.com')
        ;
        $manager->persist($user);

        $user = new User();
        $user->setUsername('admin')
            ->setPassword($this->encodePassword($user,'admin'))
            ->setIsActive(true)
            ->setRoles(array("ROLE_ADMIN"))
            ->setEmail('admin@son.com')
        ;
        $manager->persist($user);

        $manager->flush();
    }

    private function encodePassword($user, $plainPassword){
        $encoder = $this->container->get('security.encoder_factory')
            ->getEncoder($user);

        return $encoder->encodePassword($plainPassword,$user->getSalt());
    }
}