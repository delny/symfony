<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FavouriteController extends Controller
{
    /**
     * @Route("/myfav", name="app_fav_list")
     */
    public function listFavouriteAction(Request $request)
    {
        //on cree instance de tweetmanager
        $tweetmanager = $this->container->get('app.tweet_manager');

        //on recup l'user
        $user = $this->getUser();

        //recupere les tweets en favoris
        $tweets = $tweetmanager->getFavouritesTweetsByUser($user);

        //retour de la vue
        return $this->render(':tweet:list.html.twig', array(
            'tweets' => $tweets,
        ));
    }
}
