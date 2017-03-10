<?php

namespace AppBundle\Repository;
use AppBundle\Entity\User;

/**
 * TweetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FavouriteRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param User $user
     * @return array
     */
    public function getFavouritesTweetsByUser(User $user)
    {
        return $this->createQueryBuilder('f')
            ->select('f.tweet')
            ->innerJoin('f.tweet','t','WITH','f.tweet_id = t.id')
            ->andWhere('f.user_id = :iduser')
            ->setParameter(':iduser',$user->getId())
            ->getQuery()
            ->getResult();
    }
}
