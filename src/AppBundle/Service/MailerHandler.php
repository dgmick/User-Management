<?php
/**
 * Created by PhpStorm.
 * User: dgmick
 * Date: 27/07/2019
 * Time: 15:55
 */

namespace AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use UserBundle\Model\UserInterface;

class MailerHandler
{
    /** @var  \Swift_Mailer*/
    protected $swiftmailer;

    /** @var EngineInterface  */
    protected $twig;

    public function __construct(\Swift_Mailer $swiftmailer, EngineInterface $twig)
    {
        $this->swiftmailer = $swiftmailer;
        $this->twig = $twig;
    }

    public function registrationSuccess(UserInterface $user)
    {
        $message = \Swift_Message::newInstance()
            ->setContentType('text/html')
            ->setSubject('Modification du profile')
            ->setFrom('lutmickael@gmail.com')
            ->setTo('lutmickael@gmail.com')
            ->setBody($this->twig->render('@App/Mail/Layout/registration_success.html.twig', array(
                'user' => $user
            )))
        ;
        $this->swiftmailer->send($message);
    }
}
