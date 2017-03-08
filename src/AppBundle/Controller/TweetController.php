<?php

namespace AppBundle\Controller;

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
        // retourne les derniers tweets
        return $this->render('tweet/list.html.twig', array(
            'tweets' => array(
                array('pseudo' => 'toto', 'contenu' =>'mon premier tweet'),
                array('pseudo' => 'toto', 'contenu' =>'mon deuxieme tweet'),
                array('pseudo' => 'supertoto', 'contenu' =>'je fais un tweet moi aussi'),
            ),
        ));
    }
    /**
     * @Route("/new-tweet", name="app_tweet_new")
     */
    public function newtweetAction(Request $request)
    {
        if (isset($_POST['message']))
        {
            $reponse = 'message bien re&ccedil;';
        }
        else
        {
            $reponse = 'rien !';
        }
        // replace this example code with whatever you need
        return $this->render('tweet/new.html.twig', array(
            'reponse' => $reponse,
        ));
    }
}
