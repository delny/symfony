<?php
// src/AppBundle/Manager/UserManager.php

namespace AppBundle\Manager;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserManager {

    private $manager;

    /**
     * UserManager constructor.
     * @param EntityManagerInterface $manager
     */
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getAllUser()
    {
        return $this->manager->getRepository(User::class)->getAllUser();
    }
}