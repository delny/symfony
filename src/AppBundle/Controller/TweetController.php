<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tweet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TweetController extends Controller
{
    /**
     * @Route("/", name="app_tweet_list")
     */
    public function listAction(Request $request)
    {
         //recupere les derniers tweets
        $tweets = $this->getDoctrine()->getRepository(Tweet::class)->get_all_tweets();
        //retour de la vue
        return $this->render(':tweet:list.html.twig', array(
            'tweets' => $tweets,
        ));
    }
    /**
     * @Route("/new-tweet", name="app_tweet_new", methods={"POST"})
     */
    public function newAction(Request $request)
    {
        // si post bien reçu
        if (isset($_POST['message']))
        {
            $reponse = 'message bien re&ccedil;u';
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
