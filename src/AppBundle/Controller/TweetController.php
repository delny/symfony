<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tweet;
use AppBundle\Form\TweetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
    public function viewAction($id)
    {
        if(!$id OR (intval($id)==0))
        {
            throw new NotFoundHttpException('Id tweet incorrect !!');
        }
        //on recupere le tweet correspondant
        $tweet = $this->getDoctrine()->getRepository(Tweet::class)->getTweetById($id);
        if (!$tweet)
        {
            throw new NotFoundHttpException(sprintf('Tweet numero "%d" introuvable !',$id));
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
        //on instancie le tweet
        $tweet = new Tweet();

        //on construit le formulaire
        $form = $this->createForm(TweetType::class, $tweet);

        $form->handleRequest($request);
        if ($form->isSubmitted() AND $form->isValid() )
        {
            //formulaire valide

            //manager
            $manager = $this->getDoctrine()->getManager();

            //ajout du tweet à la bdd
            $manager->persist($tweet);
            $manager->flush();

            //retourne vers detail tweet
            return $this->redirectToRoute('app_tweet_view',['id'=> $tweet->getId()]);
        }

        return $this->render(':tweet:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
