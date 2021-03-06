<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Tweet;
use AppBundle\Entity\User;

/**
 * TweetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TweetRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param int $maxresults
     * @return array
     */
    public function getLastTweets($maxresults)
    {
        return $this->createQueryBuilder('t')
            ->select('t.message,t.id,t.createdAt')
            ->orderBy('t.createdAt','DESC')
            ->setMaxResults($maxresults)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $idTweet
     * @return mixed
     */
    public function getTweetById($idTweet)
    {
        return $this->createQueryBuilder('t')
            ->select('t.message,t.id,t.createdAt')
            ->where('t.id = :id')
            ->setParameter(':id',$idTweet)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param User $user
     * @return array
     */
    public function getFavouritesTweetsByUser(User $user)
    {
        return $this->createQueryBuilder('t')
            ->select('t.message, t.id, t.createdAt')
            ->innerJoin('favourite as f ON f.tweet_id = t.id','alias')
            ->andWhere('f.user = :iduser')
            ->setParameter(':iduser',$user->getId())
            ->getQuery()
            ->getResult();
    }
}
