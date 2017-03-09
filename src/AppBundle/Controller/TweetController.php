<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tweet;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TweetController extends Controller
{
    /**
     * @Route("/", name="app_tweet_list")
     */
    public function listAction(Request $request)
    {
         //recupere les derniers tweets
        $tweets = $this->getDoctrine()->getRepository(Tweet::class)->getLastTweets(
            $this->getParameter('app.tweet.nb_last')
        );
        //retour de la vue
        return $this->render(':tweet:list.html.twig', array(
            'tweets' => $tweets,
        ));
    }

    /**
     * @Route("/tweet/{id}", name="app_tweet_view")
     */
    public function viewAction(Request $request,$id)
    {
        if(!$id OR (intval($id)==0))
        {
            throw new NotFoundHttpException('Id tweet incorrect !!');
        }

        //on recupere le tweet correspondant
        $tweet = $this->getDoctrine()->getRepository(Tweet::class)->getTweetById($id);
        if (!$tweet)
        {
            throw new NotFoundHttpException('Tweet introuvable !');
        }

        //retour de la vue
        return $this->render(':tweet:view.html.twig',array(
            'tweet' => $tweet,
        ));

    }
    /**
     * @Route("/new-tweet", name="app_tweet_new", methods={"GET","POST"})
     */
    public function newAction(Request $request)
    {
        $message = $request->request->get('message');
        // si post bien reçu
        if (isset($message))
        {
            $reponse = 'message vaut :'.$message;

            //manager
            $manager = $this->getDoctrine()->getRepository(Tweet::class)->getEntityManager();

            //ajout du tweet à la bdd
            $tweet = new Tweet();
            $tweet->setMessage($message);
            $manager->persist($tweet);
            $manager->flush();
        }
        else
        {
            $reponse = 'rien !';
        }
        // replace this example code with whatever you need
        return $this->render(':tweet:new.html.twig', array(
            'reponse' => $reponse,
        ));
    }
}
