<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use UserBundle\Entity\User;

class LoadUserData implements FixtureInterface,  OrderedFixtureInterface
{
    
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('marc');

        $manager->persist($user);
        $manager->flush();

        $this->addReference('user', $user);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}