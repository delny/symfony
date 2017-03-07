<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
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
    /**
     * @Route("/profil", name="pageprofil")
     */
    public function profilAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/profil.html.twig', array(
            'name' => 'john',
            'tweets' => array(
                array('pseudo' => 'toto', 'contenu' =>'mon premier tweet'),
                array('pseudo' => 'toto', 'contenu' =>'mon deuxieme tweet'),
                array('pseudo' => 'supertoto', 'contenu' =>'je fais un tweet moi aussi'),
            ),
        ));
    }
}
