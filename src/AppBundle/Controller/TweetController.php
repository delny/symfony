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
        //on cree instance de tweetmanager
        $tweetmanager = $this->container->get('app.tweet_manager');

         //recupere les derniers tweets
        $tweets = $tweetmanager->getLast();

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
        //appel du tweetmanager
        $tweetmanager = $this->container->get('app.tweet_manager');
        //on creer un instance de tweet
        $tweet = $tweetmanager->create();

        //on construit le formulaire
        $form = $this->createForm(TweetType::class, $tweet);

        $form->handleRequest($request);
        if ($form->isSubmitted() AND $form->isValid())
        {
            //si le formulaire est valide

            //ajout du tweet à la bdd
            $tweetmanager->save($tweet);

            //message de notification
            $this->addFlash(
                'success',
                'Votre tweet a bien été envoyé !'
            );

            //on appel emailmessenger
            $emailMessenger = $this->container->get('app.email_messenger');
            //on envoie un mail
            $emailMessenger->sendTweetCreated($tweet);

            //retourne vers detail tweet
            return $this->redirectToRoute('app_tweet_view',['id'=> $tweet->getId()]);
        }

        return $this->render(':tweet:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
