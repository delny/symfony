<?php
// src/AppBundle/Manager/TweetManager.php
namespace AppBundle\Manager;
use AppBundle\Entity\Tweet;

class TweetManager {

    private $manager;
    private $nbLastTweet;

    /**
     * TweetManager constructor.
     * @param $manager
     * @param $nb_last_tweet
     */
    public function __construct($manager, $nbLastTweet)
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
        $this->manager->persist($tweet);
        $this->manager->flush($tweet);
    }

    /**
     * @return mixed
     */
    public function getLast()
    {
        return $this->manager->getRepository(Tweet::class)->getLastTweets($this->nbLastTweet);
    }
}