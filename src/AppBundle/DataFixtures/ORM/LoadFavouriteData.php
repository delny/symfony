<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use AppBundle\Entity\Favourite;

class LoadFavouriteData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $favourite = new Favourite();
        $favourite->setTweet($this->getReference('tweet-0'));
        $favourite->setUser($this->getReference('user-0'));
        $manager->persist($favourite);
        $favourite = new Favourite();
        $favourite->setTweet($this->getReference('tweet-1'));
        $favourite->setUser($this->getReference('user-0'));
        $manager->persist($favourite);
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 30;
    }
}