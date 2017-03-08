<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/twig-test", name="app_twig_test")
     */
    public function totoAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render(':default:toto.html.twig', array(
            'name' => 'john',
            'days' => array('lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche'),
            'html' => '<b>Ce texte n\'est pas en gras!</b>',
        ));
    }
}
