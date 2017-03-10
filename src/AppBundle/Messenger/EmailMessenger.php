<?php
// src/AppBundle/Messenger/EmailMessenger

namespace AppBundle\Messenger;

use AppBundle\Entity\Tweet;

class EmailMessenger {

    private $mailer;

    /**
     * EmailMessenger constructor.
     * @param $mailer
     */
    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Tweet $tweet
     */
    public function sendTweetCreated(Tweet $tweet)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('nouveau tweet')
            ->setFrom('mailer@twitter.com')
            ->setTo('admin@twitter.com')
            ->setBody('Un nouveau tweet a été envoyé : '.$tweet->getMessage());
        $this->mailer->send($message);
    }
}