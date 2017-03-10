<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function listAction()
    {
        //recup du usermanager
        $userManager = $this->container->get('app.user_manager');

        $users = $userManager->getAllUser();

    }
}