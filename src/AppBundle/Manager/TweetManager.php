<?php
// src/AppBundle/Manager/TweetManager.php
namespace AppBundle\Manager;
use AppBundle\Entity\Tweet;
use Doctrine\ORM\EntityManagerInterface;

class TweetManager {

    private $manager;
    private $nbLastTweet;

    /**
     * TweetManager constructor.
     * @param $manager
     * @param $nb_last_tweet
     */
    public function __construct(EntityManagerInterface $manager, $nbLastTweet)
    {
        $this->manager = $manager;
        $this->nbLastTweet = $nbLastTweet;
    }

    /**
     * @return Tweet
     */
    public function create()
    {
        return new Tweet();
    }

    /**
     * @param Tweet $tweet
     */
    public function save(Tweet $tweet)
    {
        if ($tweet->getId() === null)
        {
            $this->manager->persist($tweet);
        }
        $this->manager->flush($tweet);
    }

    /**
     * @return mixed
     */
    public function getLast()
    {
        return $this->manager->getRepository(Tweet::class)->getLastTweets($this ->nbLastTweet);
    }
}